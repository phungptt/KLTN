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

    public static function GetHotelLocationAvailable($type_of_place = null) {
        $hotels = (new Query())
                            -> select([
                                '*',
                                'place_image.name as name',
                                'r.name as room_name',
                            ])
                            ->from('place_image')
                            ->leftJoin('room as r','place_image.id = r.id_place')
                            ->where(['and', ['place_image.id_type_of_place' => $type_of_place]])
                            ->all();
        $hotelsResult = array();
        for($i = 0; $i < count($hotels); $i++) {
            $hotels[$i]['path'] = ImageService::GetOriginalPath($hotels[$i]['path']);
            for($j = 1; $j < count($hotels); $j++) {
                if($hotels[$i]['id_place'] == $hotels[$j]['id_place']) {
                    if($hotels[$i]['price'] >= $hotels[$j]['price']) {
                        array_push($hotelsResult,$hotels[$j]);
                    }
                }
            }
        }
        dd($hotelsResult);
        // return $hotelsResult;
    }

    public static function GetLocationBySlug($slug) {
        $location = PlaceImage::find()->where(['slug' => $slug])->andWhere(['and', ['status' => self::$AVALABLE], ['deleted' => self::$ALIVE]])->asArray()->one();

        $location['path'] = ImageService::GetOriginalPath($location['path']);

        return $location;
    }

    public static function GetImagesRelateByPlaceId($id) {
        $images = (new Query())
                                        ->select('path')
                                        ->from('image_file as f')
                                        ->leftJoin('image_ref as r', 'f.id = r.image_id')
                                        ->where(['and', ['r.object_type' => 'app\modules\app\models\Place'], ['r.object_id' => $id]])
                                        ->andWhere(['relate' => 1])
                                        ->all();

        foreach($images as &$img) {
            $img['path'] = ImageService::GetOriginalPath($img['path']);
        }                               
        return $images;
    }
}