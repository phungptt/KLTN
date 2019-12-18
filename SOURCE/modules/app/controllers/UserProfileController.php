<?php 

namespace app\modules\app\controllers;

use yii\web\Controller;

class UserProfileController extends Controller
{
     public function actionIndex() {
          return $this->render('user-profile');
     }
}