<?php 

namespace app\modules\app\services;

use app\modules\app\models\Amenities;
use app\modules\app\models\Comment;
use app\modules\app\models\Rating;
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
    public static $HOTEL_TYPE = 0;

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

    public static function CreatePlaceComment($data) {
        $comment = new Comment();
        if($data['rating'] != 0 && $data['Comment']['short_description'] != '' && $data['Comment']['content']) {
            $rating = new Rating([
                'id_user' => Yii::$app->user->id,
                'rating' => $data['rating'],
                'object_type' => 'app\modules\app\models\Place',
                'object_id' =>  $data['id_place']
            ]);
    
            $comment->load($data);
            $comment->create_by = Yii::$app->user->id;
            $comment->status = self::$AVALABLE;
            $comment->delete = self::$ALIVE;
            $comment->object_type = 'app\modules\app\models\Place';
            $comment->object_id =  $data['id_place'];
    
    
            if($comment->save(false)) {
                $comment->save();
                $rating->save();
                return [
                    'status' => true,
                    'message' => 'Thêm nhận xét thành công'
                ];
            }
        }
        return [
            'status' => false,
            'message' => 'Vui lòng điền đầy đủ các trường thông tin có dấu (*)'
        ];
    }

    public static  function GetIdPlaceBySlug($slug)
    {
        $id_place = (new Query())
                                    -> select([
                                        'place.id'
                                    ])
                                    ->from('place')
                                    ->where(['and', ['place.slug' => $slug]])
                                    ->all();
        dd($id_place);
        return $id_place;
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

    public static function GetLocationAvailable($type_of_place = null, $keyword='') {
        $query = (new Query())
                            -> select([
                                '*',
                                'place_image.id as id_place',
                                'place_image.name as name',
                                'r.name as room_name',
                            ])
                            ->from('place_image')
                            ->leftJoin('room as r','place_image.id = r.id_place')
                            ->where(['and', ['place_image.id_type_of_place' => $type_of_place], ['like', 'place_image.name', $keyword]])
                            ->orderBy('price')
                            ->all();
        $queryRating = (new Query())
                                                -> select([
                                                    'AVG(rating.rating)',
                                                    'COUNT(rating.rating) as rating_number',
                                                    'rating.object_id as id'
                                                ])
                                                ->from('rating')
                                                ->groupBy(['rating.object_id'])
                                                ->all();
        $queryComment = (new Query())
                                                -> select([
                                                    'COUNT(comment.content) as comment_count',
                                                    'comment.object_id as id'
                                                ])
                                                ->from('comment')
                                                ->groupBy(['comment.object_id'])
                                                ->all();

        if($type_of_place == self::$HOTEL_TYPE) {
            $hotels = [];
            foreach($query as &$h) {
                if(!isset($hotels[$h['id_place']])) {
                    $h['path'] = ImageService::GetOriginalPath($h['path']);
                    $h['price'] = number_format($h['price']);

                    for($i = 0; $i < count($queryRating); $i++) {
                        if($h['id_place'] == $queryRating[$i]['id']) {
                            list($h['rating'], $h['rating_number']) = array($queryRating[$i]['avg'], $queryRating[$i]['rating_number']);
                        }
                    }

                    for($i = 0; $i < count($queryComment); $i++) {
                        if($h['id_place'] == $queryComment[$i]['id']) {
                            $h['comment_number'] = $queryComment[$i]['comment_count'];
                        }
                    }
                    $hotels[$h['id_place']] = $h;
                }
            }      
            return $hotels;
        } else {
            foreach($query as &$location) {
                $location['path'] = ImageService::GetOriginalPath($location['path']);
                for($i = 0; $i < count($queryRating); $i++) {
                    if($location['id_place'] == $queryRating[$i]['id']) {
                        list($location['rating'], $location['rating_number']) = array($queryRating[$i]['avg'], $queryRating[$i]['rating_number']);
                    }
                }
                for($i = 0; $i < count($queryComment); $i++) {
                    if($location['id_place'] == $queryComment[$i]['id']) {
                        $location['comment_number'] = $queryComment[$i]['comment_count'];
                    }
                }
            }
        }
       
        return $query;
    }

    public static function GetLocationBySlug($slug) {
        $location = PlaceImage::find()->where(['slug' => $slug])->andWhere(['and', ['status' => self::$AVALABLE], ['deleted' => self::$ALIVE]])->asArray()->one();

        $location['path'] = ImageService::GetOriginalPath($location['path']);

        return $location;
    }

    public static function GetRatingByPlaceId($id) {
        $rating = (new Query())
                            -> select('AVG(rating)')
                            ->from('rating as r')
                            ->innerJoin('place as p', 'p.id = object_id')
                            ->where(['and', ['r.object_type' => 'app\modules\app\models\Place'], ['r.object_id' => $id]])
                            ->one();

        return $rating;
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

    public static function GetRoomByPlaceId($id) {
        $rooms = (new Query())
                                        ->select('*')
                                        ->from('room as r')
                                        ->where(['and', ['r.id_place' => $id]])
                                        ->all();
        foreach($rooms as &$r) {
            $r['price'] = number_format($r['price']);
        }
        return $rooms;
    }

    public static function GetCommentListByPlaceId($id) {
        $comments = (new Query())
                                        ->select([
                                           'comment.short_description',
                                           'comment.create_at',
                                           'comment.content',
                                           'u.fullname as user_name'
                                        ])
                                        ->from('comment')
                                        ->innerJoin('place as p', 'comment.object_id = p.id')
                                        ->innerJoin('user_info as u', 'comment.create_by = u.user_id')
                                        ->where(['and', ['comment.object_id' => $id]])
                                        ->all();
        return $comments;
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