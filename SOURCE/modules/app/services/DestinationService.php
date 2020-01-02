<?php 

namespace app\modules\app\services;

use app\modules\app\models\DiemDen;
use app\modules\app\services\ImageService;
use app\modules\contrib\helper\ConvertHelper;
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

    public static function CreateNewDestination($image, $imageRelate, $data) {
        if($image->imageFile) {
            $imageFile = ImageService::SaveImage($image);

            if($imageFile) {
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

    public static function CreateWorkAndRef($data, $avatar, $imageRelateFiles) {
        $model = new DiemDen();
        
        $model->load($data);
        $model->created_by = Yii::$app->user->id;
        $model->viewed = 0;
        $model->slug = SiteService::uniqid() . SiteService::convertStringToSlug($model->name);
        $model->status = self::$AVALABLE;
        $model->deleted = self::$ALIVE;
        $model->lat = $data['lat'];
        $model->lng = $data['lng'];

        if($model->save()) {
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

    public static function GetDestinationsAvailable() {
        $destinations = DestinationImage::find()->where(['and', ['status' => self::$AVALABLE], ['deleted' => self::$ALIVE]])->asArray()->all();

        foreach($destinations as &$dest) {
            $dest['path'] = ImageService::GetThumbnailPath($dest['path']);
        }
        return $destinations;
    }

    public static function GetDestinations($limit = null) {
        $destinations = DiemDen::find();
        if($limit) {
            $destinations->limit($limit);
        }
        return $destinations->all();
    }

    public static function GetArrayDestination() {
        $destinations = DiemDen::find()->select('name')->indexBy('id')->orderBy('created_at')->column();

        return $destinations;
    }

    public static function GetDestinationBySlug($slug) {
        $destination = DestinationImage::find()->where(['slug' => $slug])->andWhere(['and', ['status' => self::$AVALABLE], ['deleted' => self::$ALIVE]])->asArray()->one();
        $destination['path'] = ImageService::GetOriginalPath($destination['path']);
        return $destination;
    }

    public static function GetImagesRelateByDestinationId($id) {
        $images = (new Query())
                                        ->select('path')
                                        ->from('image_file as f')
                                        ->leftJoin('image_ref as r', 'f.id = r.image_id')
                                        ->where(['and', ['r.object_type' => 'app\modules\app\models\DiemDen'], ['r.object_id' => $id]])
                                        ->andWhere(['relate' => 1])
                                        ->all();

        foreach($images as &$img) {
            $img['path'] = ImageService::GetOriginalPath($img['path']);
        }                               
        return $images;
    }

    public static function GetDestinationNameById($id) {
        $destination = DiemDen::findOne($id);
        return $destination ? $destination->name : null;
    }
}