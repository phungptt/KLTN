<?php

namespace app\modules\app\controllers;

use app\modules\app\models\Plan;
use app\modules\app\services\DestinationService;
use yii\web\Controller;

class PlanController extends Controller
{
     public function actionCreatePlan() {
          $model = new Plan();
          $destinations = DestinationService::GetArrayDestination();
          return $this->render('create-plan', compact('destinations', 'model'));
     }

     public function actionCreatePlanDetail() {
          return $this->render('create-plan-detail');
     }

     public function actionPlanTripDetail() {
          return $this->render('plan-trip-detail');
     }

     public function actionPlanList() {
          return $this->render('plan-list');
     }
}