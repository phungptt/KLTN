<?php 

namespace app\modules\app\controllers;

use app\modules\app\models\DiemDen;
use app\modules\app\services\DiemDenService;
use yii\web\UploadedFile;
use app\modules\app\models\UploadImage;
use app\modules\app\models\UploadImages;
use Yii;
use yii\web\Controller;

class DestinationController extends Controller
{
     public function actionCreate() {
          $model = new DiemDen();

          $request = Yii::$app->request;
          if($request->isPost) {
               $image = new UploadImage();
               $image->imageFile = UploadedFile::getInstance($image, 'imageFile');

               $imageRelate = new UploadImages();
               $imageRelate->imageFiles = UploadedFile::getInstances($imageRelate, 'imageFiles');

               $saved = DiemDenService::CreateNewDestination($image, $imageRelate, $request->post());
               if($saved) {
                    Yii::$app->session->setFlash('success', 'Lưu thành công điểm đến mới');
                    return $this->refresh();
               } 

               $response = [
                    'status' => false,
                    'message' => 'Không thể lưu'
               ];
               return $this->asJson($response);
          }
          return $this->render('create', compact('model'));
     }

     public function actionEdit() {
          return $this->render('edit');
     }

     public function actionDelete() {

          return true;
     }

     public function actionDestinationList() {
          return $this->render('destination-list');
     }

     public function actionDestinationDetail() {
          return $this->render('destination-detail');
     }
}