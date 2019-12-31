<?php 

namespace app\modules\app\controllers;

use app\modules\app\models\DiemDen;
use app\modules\app\models\DestinationImage;
use app\modules\app\models\ImageFile;
use app\modules\app\services\DestinationService;
use yii\web\UploadedFile;
use app\modules\app\models\UploadImage;
use app\modules\app\models\UploadImages;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use app\modules\app\AppConfig;
use app\modules\app\services\ImageService;
use Codeception\PHPUnit\Constraint\Page;
use yii\helpers\ArrayHelper;
use yii\web\Request;

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
               $saved = DestinationService::CreateNewDestination($image, $imageRelate, $request->post());
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
          $destinations = DestinationImage::find()->all();

          foreach($destinations as $dest) {
               $dest['path'] =  ImageService::GetOriginalPath($dest->path);
          }
          $destinations = ArrayHelper::toArray($destinations);
          return $this->render('destination-list', compact('destinations'));
     }

     public function actionDestinationDetail($slug=null) {
          // - Select destination with slug 
          $destination = DiemDen::find()->where(['slug' => $slug])->one();
          $destination = ArrayHelper::toArray($destination);

          // - Select background image of destination
          $image = DestinationImage::find()->where(['id' => $destination['id']])->one();
          $image['path'] =  ImageService::GetOriginalPath($image->path);
          $image = ArrayHelper::toArray($image);

          // - Select image relate of destination
          $imageRelate = ImageFile::find()->all();
          foreach($imageRelate as $imageRelate) {
               $imageRelate['slug'] =  strtok($imageRelate->slug);
          }
          dd($imageRelate);
          return $this->render('destination-detail', compact('destination', 'image'));
     }
}