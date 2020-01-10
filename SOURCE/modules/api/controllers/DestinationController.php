<?php 

namespace app\modules\api\controllers;

use app\modules\app\services\DestinationService;
use Yii;
use yii\web\Controller;

class DestinationController extends Controller
{
    public $enableCsrfValidation = false;
    
    public function actionGetDestinationList() {
        $request = Yii::$app->request;

        if($request->isPost) {
            $name = $request->post('keyword');
            
            $des = DestinationService::GetDestinationsAvailable($name);
            // dd($des);

            $response = [
                'status' => true,
                'des' => [
                    'data' => $des,
                ]
        ];
        return $this->asJson($response);
        }
   
           throw new \yii\web\NotFoundHttpException();
    }
}