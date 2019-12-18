<?php 

namespace app\modules\app\controllers;

use yii\web\Controller;

class PlanTripDetailController extends Controller
{
     public function actionIndex() {
          return $this->render('plan-trip-detail');
     }
}