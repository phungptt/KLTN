<?php 

namespace app\modules\app\controllers;

use yii\web\Controller;

class PlaceController extends Controller
{
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