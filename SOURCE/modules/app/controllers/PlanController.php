<?php

namespace app\modules\app\controllers;

use yii\web\Controller;

class PlanController extends Controller
{
     public function actionCreatePlan() {
          return $this->render('create-plan');
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