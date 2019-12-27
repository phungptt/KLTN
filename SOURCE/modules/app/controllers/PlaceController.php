<?php 

namespace app\modules\app\controllers;

use app\modules\app\models\Food;
use app\modules\app\models\Place;
use app\modules\app\models\Room;
use app\modules\app\services\PlaceService;
use yii\web\UploadedFile;
use app\modules\app\models\UploadImage;
use app\modules\app\models\UploadImages;
use app\modules\app\models\VisitLocation;
use app\modules\app\services\DestinationService;
use Yii;
use yii\web\Controller;

class PlaceController extends Controller
{
     public function actionCreate() {
          $model = new Place();
          $food = new Food();
          $room = new Room();
          $visit = new VisitLocation();

          $destinations = DestinationService::GetArrayDestination();

          $request = Yii::$app->request;
          if($request->isPost) {
               $image = new UploadImage();
               $image->imageFile = UploadedFile::getInstance($image, 'imageFile');
               
               $imageRelate = new UploadImages();
               $imageRelate->imageFiles = UploadedFile::getInstances($imageRelate, 'imageFiles');

               $saved = PlaceService::CreateNewPlace($image, $imageRelate, $request->post());
               
               return $this->asJson($saved);
          }
          return $this->render('create', compact('model', 'room', 'food', 'visit', 'destinations'));
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