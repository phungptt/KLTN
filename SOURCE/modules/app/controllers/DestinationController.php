<?php 

namespace app\modules\app\controllers;

use yii\web\Controller;

class DestinationController extends Controller
{
     public function actionDestinationDetail() {
          return $this->render('destination-detail');
     }
}