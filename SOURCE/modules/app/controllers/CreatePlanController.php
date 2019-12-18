<?php 

namespace app\modules\app\controllers;

use yii\web\Controller;

class CreatePlanController extends Controller
{
     public function actionIndex() {
          return $this->render('create-plan');
     }
}