<?php

namespace app\modules\app\services;

use app\modules\app\models\DiemDen;
use app\modules\app\services\ImageService;
use app\modules\contrib\helper\ConvertHelper;
use app\modules\app\models\Comment;
use app\modules\app\models\Rating;

use Yii;
use app\modules\app\APPConfig;
use app\modules\app\models\DestinationImage;
use yii\db\Query;

class DestinationService
{
    public static $AVALABLE = 1;
    public static $PENDING = 0;

    public static $DELETED = 1;
    public static $ALIVE = 0;

    public static $DEFAUL_DESTINATION_AVATAR =  'resources/images/default-destination-avatar.jpg';

    public static function CreateNewDestination($image, $imageRelate, $data)
    {
        if ($image->imageFile) {
            $imageFile = ImageService::SaveImage($image);

            if ($imageFile) {
                //Save place images
                $imageRelateFiles = ImageService::SaveImages($imageRelate);

                //Create thumbnail
                ImageService::CreateThumbnailForImage($imageFile->path);

                //Save place information and reference
                $response = self::CreateWorkAndRef($data, $imageFile, $imageRelateFiles);
                return $response;
            }

            return [
                'status' => false,
                'message' => 'Không thể lưu tác phẩm, kích thước tối đa 10MB'
            ];
        }
        return [
            'status' => false,
            'message' => 'Vui lòng chọn ảnh đại diện cho điểm đến'
        ];
    }

    public static function CreateWorkAndRef($data, $avatar, $imageRelateFiles)
    {
        $model = new DiemDen();

        $model->load($data);
        $model->created_by = Yii::$app->user->id;
        $model->viewed = 0;
        $model->slug = SiteService::uniqid() . SiteService::convertStringToSlug($model->name);
        $model->status = self::$AVALABLE;
        $model->deleted = self::$ALIVE;
        $model->lat = $data['lat'];
        $model->lng = $data['lng'];

        if ($model->save()) {
            ImageService::SaveImageRef($avatar->id, $model->className(), $model->id);
            ImageService::SaveImagesRef($imageRelateFiles, $model->className(), $model->id);

            return [
                'status' => true,
                'message' => 'Thêm tác phẩm thành công'
            ];
        }

        return [
            'status' => false,
            'message' => 'Vui lòng điền đầy đủ các trường thông tin có dấu (*)'
        ];
    }

    public static function GetDestinationsAvailable($name = null)
    {
        $destinations = DestinationImage::find()->where(['and', ['status' => self::$AVALABLE], ['deleted' => self::$ALIVE], ['like', 'name', $name]])->asArray()->all();

        foreach ($destinations as &$dest) {
            $dest['path'] = ImageService::GetThumbnailPath($dest['path']);
        }
        return $destinations;
    }

    public static function GetDestinations($limit = null)
    {
        $destinations = DiemDen::find();
        if ($limit) {
            $destinations->limit($limit);
        }
        return $destinations->all();
    }

    public static function GetArrayDestination()
    {
        $destinations = DiemDen::find()->select('name')->indexBy('id')->orderBy('created_at')->column();

        return $destinations;
    }

    public static function GetDestinationBySlug($slug)
    {
        $destination = DestinationImage::find()->where(['slug' => $slug])->andWhere(['and', ['status' => self::$AVALABLE], ['deleted' => self::$ALIVE]])->asArray()->one();
        $destination['path'] = ImageService::GetOriginalPath($destination['path']);
        return $destination;
    }

    public static function GetImagesRelateByDestinationId($id)
    {
        $images = (new Query())
            ->select('path')
            ->from('image_file as f')
            ->leftJoin('image_ref as r', 'f.id = r.image_id')
            ->where(['and', ['r.object_type' => 'app\modules\app\models\DiemDen'], ['r.object_id' => $id]])
            ->andWhere(['relate' => 1])
            ->all();

        foreach ($images as &$img) {
            $img['path'] = ImageService::GetOriginalPath($img['path']);
        }
        return $images;
    }

    public static function GetDestinationNameById($id)
    {
        $destination = DiemDen::findOne($id);
        return $destination ? $destination->name : null;
    }

    public static function GetTopPlace($id, $limit)
    {
        $query = (new Query())
                                ->select([
                                    'p.name',
                                    'p.slug',
                                    'p.path',
                                    'p.id_type_of_place',
                                    'AVG(r.rating) as rating_avg',
                                ])
                                ->from('place_image as p')
                                ->innerJoin('rating as r', 'r.object_id = p.id')
                                ->where(['and', ['p.id_destination' => $id], ['r.object_type' => 'app\modules\app\models\Place']])
                                ->groupBy(['p.name', 'p.slug', 'p.path','p.id_type_of_place'])
                                ->orderBy(['rating_avg' => SORT_DESC])
                                ->all();
        foreach($query as &$q) {
            $q['path'] = ImageService::GetThumbnailPath($q['path']);
        }         

        return $query;
    }
    public static function SelectionSortDescending($mang)
    {
        // Đếm tổng số phần tử của mảng
        $sophantu = count($mang);
        // Lặp để sắp xếp
        for ($i = 0; $i < $sophantu - 1; $i++) {
            // Tìm vị trí phần tử lớn nhất
            $max = $i;
            for ($j = $i + 1; $j < $sophantu; $j++) {
                if ($mang[$j]['rating_avg'] > $mang[$max]['rating_avg']) {
                    $max = $j;
                }
            }
            // Sau khi có vị trí lớn nhất thì hoán vị
            // với vị trí thứ $i
            $temp = $mang[$i];
            $mang[$i] = $mang[$max];
            $mang[$max] = $temp;
        }
        // Trả về mảng đã sắp xếp
        return $mang;
    }

    public static function CreateDestinationComment($data) {
        $comment = new Comment();
        if($data['rating'] != 0 && $data['Comment']['short_description'] != '' && $data['Comment']['content']) {
            $rating = new Rating([
                'id_user' => Yii::$app->user->id,
                'rating' => $data['rating'],
                'object_type' => 'app\modules\app\models\DiemDen',
                'object_id' =>  $data['id_place']
            ]);
    
            $comment->load($data);
            $comment->create_by = Yii::$app->user->id;
            $comment->status = self::$AVALABLE;
            $comment->delete = self::$ALIVE;
            $comment->object_type = 'app\modules\app\models\DiemDen';
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

    public static function GetCommentListByPlaceId($id) {
        $comments = (new Query())
                                        ->select([
                                           'comment.short_description',
                                           'comment.create_at',
                                           'comment.content',
                                           'u.fullname as user_name'
                                        ])
                                        ->from('comment')
                                        ->innerJoin('diem_den as d', 'comment.object_id = d.id')
                                        ->innerJoin('user_info as u', 'comment.create_by = u.user_id')
                                        ->where(['and', ['comment.object_id' => $id]])
                                        ->all();
        return $comments;
    }

    public static function GetRatingByPlaceId($id) {
        $rating = (new Query())
                            -> select('AVG(rating)')
                            ->from('rating as r')
                            ->innerJoin('diem_den as des', 'des.id = object_id')
                            ->where(['and', ['r.object_type' => 'app\modules\app\models\DiemDen'], ['r.object_id' => $id]])
                            ->one();

        return $rating;
    }
}
