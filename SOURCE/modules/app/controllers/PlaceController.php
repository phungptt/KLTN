<?php 

namespace app\modules\app\controllers;

use app\modules\app\models\Place;
use app\modules\app\services\PlaceService;
use yii\web\UploadedFile;
use app\modules\app\models\UploadImage;
use app\modules\app\models\UploadImages;
use Yii;
use yii\web\Controller;

class PlaceController extends Controller
{
     public function actionCreate() {
          $model = new Place();

          $request = Yii::$app->request;
          if($request->isPost) {
               $image = new UploadImage();
               $image->imageFile = UploadedFile::getInstance($image, 'imageFile');

               $imageRelate = new UploadImages();
               $imageRelate->imageFiles = UploadedFile::getInstances($imageRelate, 'imageFiles');

               $saved = PlaceService::CreateNewPlace($image, $imageRelate, $request->post());
               if($saved) {
                    Yii::$app->session->setFlash('success', 'Lưu thành công địa điểm mới');
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



     public function actionDestinationDetail() {
          return $this->render('destination-detail');
     }

     public function actionHotelList() {

          return $this->render('hotel-list');
     }

     public function actionHotelDetail() {
          return $this->render('hotel-detail');
     }

     public function actionFoodList() {
          return $this->render('food-list');
     }

     public function actionFoodDetail() {
          return $this->render('food-detail');
     }

     public function actionVisitLocationList() {
          return $this->render('visit-location-list');
     }

     public function actionVisitLocationDetail() {
          return $this->render('visit-location-detail');
     }
}