<?php 

namespace app\modules\app\controllers;

use yii\web\Controller;

class CreatePlanDetailController extends Controller
{
     public function actionIndex() {
          return $this->render('create-plan-detail');
     }
}