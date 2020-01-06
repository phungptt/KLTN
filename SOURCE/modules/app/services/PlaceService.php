<?php 

namespace app\modules\app\services;

use app\modules\app\models\Amenities;
use app\modules\app\models\Food;
use app\modules\app\models\Place;
use app\modules\app\models\Room;
use app\modules\app\models\VisitLocation;
use app\modules\app\services\ImageService;
use app\modules\contrib\helper\ConvertHelper;
use Yii;
use app\modules\app\models\PlaceImage;
use yii\db\Query;

class PlaceService 
{
    public static $AVALABLE = 1;
    public static $PENDING = 0;

    public static $DELETED = 1;
    public static $ALIVE = 0;

    public static $VISIT_TYPE = 2;
    public static $FOOD_TYPE = 1;
    public static $HOTEL_TYPE = 3;

    public static $PLACE_PERPAGE_PLAN = 10;

    public static $placeTypes = ['Khách sạn', 'Ăn uống', 'Tham quan'];
    public static $roomType = [
        'Phòng Standard' => 'Phòng Standard',
        'Phòng Superior' => 'Phòng Superior',
        'Phòng Deluxe' => 'Phòng Deluxe',
        'Phòng Suite' => 'Phòng Suite',
        'Phòng Executive Suite' => 'Phòng Executive Suite',
        'Phòng Dorm' => 'Phòng Dorm',
    ];

    public static function CreateNewPlace($image, $imageRelate, $data) {
        if($image->imageFile) {
            
            $imageFile = ImageService::SaveImage($image);
            
            if($imageFile) {
                //Save place images
                $imageRelateFiles = ImageService::SaveImages($imageRelate);
                //Create thumbnail
                ImageService::CreateThumbnailForImage($imageFile->path);

                //Save place information and reference
                $response = self::CreatePlaceAndRef($data, $imageFile, $imageRelateFiles);
                return $response;
            }

            return [
                'status' => false,
                'message' => 'Không thể lưu hình ảnh, kích thước tối đa 10MB'
            ];
        }
        return [
            'status' => false,
            'message' => 'Vui lòng chọn ảnh đại diện cho địa điểm'
        ];
    }

    public static function CreatePlaceAndRef($data, $avatar, $imageRelateFiles) {
        $model = new Place();
        
        $model->load($data);
        $model->create_by = Yii::$app->user->id;
        $model->viewed = 0;
        $model->slug = SiteService::uniqid() . SiteService::convertStringToSlug($model->name);
        $model->status = self::$AVALABLE;
        $model->deleted = self::$ALIVE;
        $model->id_type_of_place = intval($data['Place']['id_type_of_place']);
        $model->lat = $data['lat'];
        $model->lng = $data['lng'];

        if($model->save(false)) {
            ImageService::SaveImageRef($avatar->id, $model->className(), $model->id);
            ImageService::SaveImagesRef($imageRelateFiles, $model->className(), $model->id);
            self::SavePlaceTypeData($model, $data);

            return [
                'status' => true,
                'message' => 'Thêm địa điểm thành công'
            ];
        }

        return [
            'status' => false,
            'message' => 'Vui lòng điền đầy đủ các trường thông tin có dấu (*)'
        ];
    }

    public static function SavePlaceTypeData($place, $data) {
        if($place->id_type_of_place == 0) {
            foreach($data['Room'] as $r) {
                $room = new Room([
                    'id_place' => $place->id,
                    'name' => $r['name'],
                    'contain_number' => $r['contain_number'],
                    'price' => $r['price']
                ]);
                $room->save();
            }
        } else if ($place->id_type_of_place == 1) {
            $food = new Food();
            $food->load($data);
            $food->id_place = $place->id;
            $food->save();
        } else {
            $visit = new VisitLocation();
            $visit->id_place = $place->id;
            $visit->save();
        }
    }

    public static function GetListPlaceType() {
        $amenities = Amenities::find()->select('name')->indexBy('id')->column();
        return $amenities;
    }

    public static function GetLocationAvailable($type_of_place = null) {
        $visits = PlaceImage::find()->where(['and', ['status' => self::$AVALABLE], ['deleted' => self::$ALIVE], ['id_type_of_place' => $type_of_place]])->asArray()->all();

        foreach($visits as &$visit) {
            $visit['path'] = ImageService::GetOriginalPath($visit['path']);
        }
        return $visits;
    }

    public static function GetRoom() {
        $room = (new Query())
                                ->select(['room.name as name', 
                                                    'room.price as price',
                                                    'room.contain_number as contain_number'])
                                ->from('room')
                                ->join('LEFT OUTER JOIN', 'place', 'place.id = room.id')
                                ->all();
        return $room;
    }

    public static function GetPlaceListWithPaginations($destination, $type, $page, $keyword, $lat, $lng) {
        $perpage = self::$PLACE_PERPAGE_PLAN;
        $places = self::GetPlaceList($destination, $type, $page, $perpage, $keyword, $lat, $lng);
        $total = self::CountTotalPlaceOfList($destination, $type, $keyword, $lat, $lng);
        $paginations = SiteService::CreatePaginationMetadata($total, $page, $perpage, count($places));

        return [$places, $paginations];
    }

    public static function GetPlaceList($destination, $type, $page, $perpage, $keyword, $lat, $lng) {
        list($limit, $offset) = SiteService::GetLimitAndOffset($page, $perpage);

        if($lat === '' || $lng === '') {
            $query = "SELECT *
                        FROM place_image 
                        WHERE id_destination = " . $destination . " AND id_type_of_place = " . $type . " AND name LIKE '%" . $keyword . "%' AND status = 1 AND deleted = 0
                        LIMIT " . $limit . " OFFSET " . $offset;
        } else {
            $query = "SELECT *, ST_Distance(t.x, ST_SetSRID(ST_MakePoint(place_image.lng::double precision, place_image.lat::double precision),4326)::geography) AS dist
                        FROM place_image, (SELECT ST_GeographyFromText('SRID=4326;POINT(" . $lng . " " . $lat . ")')) AS t(x)
                        WHERE id_destination = " . $destination . " AND id_type_of_place = " . $type . " AND name LIKE '%" . $keyword . "%' AND status = 1 AND deleted = 0
                        AND ST_DWithin(t.x, ST_SetSRID(ST_MakePoint(place_image.lng::double precision, place_image.lat::double precision),4326)::geography, 200000)
                        ORDER BY dist LIMIT " . $limit . " OFFSET " . $offset;
        }
        
        $places = SiteService::CommandQueryAll($query);

        foreach($places as &$place) {
            $place['path'] = ImageService::GetThumbnailPath($place['path']);
        }

        return $places;
    }

    public static function CountTotalPlaceOfList($destination, $type, $keyword, $lat, $lng) {
        if($lat === '' || $lng === '') {
            $query = "SELECT COUNT(*)
                        FROM place_image 
                        WHERE id_destination = " . $destination . " AND id_type_of_place = " . $type . " AND name LIKE '%" . $keyword . "%' AND status = 1 AND deleted = 0";
        } else {
            $query = "SELECT COUNT(*)
                        FROM place_image, (SELECT ST_GeographyFromText('SRID=4326;POINT(" . $lng . " " . $lat . ")')) AS t(x)
                        WHERE id_destination = " . $destination . " AND id_type_of_place = " . $type . " AND name LIKE '%" . $keyword . "%' AND status = 1 AND deleted = 0
                        AND ST_DWithin(t.x, ST_SetSRID(ST_MakePoint(place_image.lng::double precision, place_image.lat::double precision),4326)::geography, 200000)";
        }

        $total = SiteService::CommandQueryOne($query);
        return $total['count'];
    }
}