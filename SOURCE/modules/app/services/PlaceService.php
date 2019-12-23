<?php 

namespace app\modules\app\services;

use app\modules\app\models\Place;
use app\modules\app\services\ImageService;
use app\modules\contrib\helper\ConvertHelper;
use Yii;

class PlaceService 
{
    public static $AVALABLE = 1;
    public static $PENDING = 0;

    public static $DELETED = 0;
    public static $ALIVE = 1;


    public static function CreateNewPlace($image, $imageRelate, $data) {
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
            'message' => 'Vui lòng chọn ảnh đại diện cho địa điểm'
        ];
    }

    public static function CreateWorkAndRef($data, $avatar, $imageRelateFiles) {
        $model = new Place();
        
        $model->load($data);
        $model->create_by = Yii::$app->user->id;
        $model->viewed = 0;
        $model->slug = ConvertHelper::convertStringToSlug($model->name);
        $model->status = self::$AVALABLE;
        $model->lat = $data['lat'];
        $model->lng = $data['lng'];

        if($model->save(false)) {
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
}