<?php

namespace app\modules\app\controllers;

use app\modules\app\models\Food;
use app\modules\app\models\Place;
use app\modules\app\models\PlaceImage;
use app\modules\app\models\Room;
use app\modules\app\models\Comment;
use app\modules\app\models\Rating;
use app\modules\app\services\PlaceService;
use app\modules\app\services\ImageService;
use yii\web\UploadedFile;
use app\modules\app\models\UploadImage;
use app\modules\app\models\UploadImages;
use app\modules\app\models\VisitLocation;
use app\modules\app\models\Amenities;
use app\modules\app\services\DestinationService;
use app\modules\app\services\PlanService;
use Yii;
use yii\web\Controller;

class PlaceController extends Controller
{
     public function actionCreate()
     {
          $model = new Place();
          $food = new Food();
          $room = new Room();
          $visit = new VisitLocation();

          $destinations = DestinationService::GetArrayDestination();

          $request = Yii::$app->request;
          if ($request->isPost) {
               $image = new UploadImage();
               $image->imageFile = UploadedFile::getInstance($image, 'imageFile');

               $imageRelate = new UploadImages();
               $imageRelate->imageFiles = UploadedFile::getInstances($imageRelate, 'imageFiles');

               $saved = PlaceService::CreateNewPlace($image, $imageRelate, $request->post());

               return $this->asJson($saved);
          }
          return $this->render('create', compact('model', 'room', 'food', 'visit', 'destinations'));
     }

     public function actionEdit()
     {

          return $this->render('edit');
     }

     public function actionDelete()
     {
          return true;
     }

     public function actionHotelList()
     {
          $model = new Place();

          $amenities = Amenities::find()->asArray()->all();
          // dd($hotelList);
          return $this->render('hotel-list', compact('model', 'amenities'));
     }

     public function actionHotelDetail($slug = null)
     {
          // - Select hotel location with slug
          $hotel = PlaceService::GetLocationBySlug($slug);
          // - Select image relate of place
          $imagesRelate = PlaceService::GetImagesRelateByPlaceId($hotel['id']);
          // - Select  hotel room
          $rooms = PlaceService::GetRoomByPlaceId($hotel['id']);

          return $this->render('hotel-detail', compact('hotel', 'imagesRelate', 'rooms'));
     }

     public function actionFoodList()
     {    
          return $this->render('food-list');
     }

     public function actionFoodDetail($slug = null)
     {
          $comment = new Comment();
          // - Select food location with slug
          $food = PlaceService::GetLocationBySlug($slug);

          // - Select image relate of place
          $imagesRelate = PlaceService::GetImagesRelateByPlaceId($food['id']);

          return $this->render('food-detail', compact('food', 'comment', 'imagesRelate'));
     }

     public function actionVisitLocationList()
     {
          return $this->render('visit-location-list');
     }

     public function actionVisitLocationDetail($slug = null)
     {
          $comment = new Comment();
          $rating = new Rating();
          $request = Yii::$app->request;

          if ($request->isPost) {
               $saved = PlaceService::CreatePlaceComment($request->post());

               return $this->asJson($saved);
          }
          // - Select food location with slug
          $visit = PlaceService::GetLocationBySlug($slug);

          // - Select image relate of place
          $imagesRelate = PlaceService::GetImagesRelateByPlaceId($visit['id']);

          // - Select comment with ID
          $comments = PlaceService::GetCommentListByPlaceId($visit['id']);

          return $this->render('visit-location-detail', compact('visit', 'comment', 'imagesRelate', 'comments'));
     }
}
