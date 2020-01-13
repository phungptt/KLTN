<?php

namespace app\modules\api\controllers;

use app\modules\app\services\UserService;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
     public $enableCsrfValidation = false;

     public function actionGetPlanList()
     {
          $request = Yii::$app->request;
          if ($request->isPost) {
               $keyword = $request->post('id_user');

               $plan = UserService::GetPlanList($keyword);
               $response = [
                    'status' => true,
                    'plan' => [
                         'data' => $plan
                    ]
               ];

               return $this->asJson($response);
          }

          throw new \yii\web\NotFoundHttpException();
     }
}
