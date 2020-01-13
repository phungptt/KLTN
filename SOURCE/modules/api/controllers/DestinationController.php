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

    public function actionCreateComment() {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $saved = DestinationService::CreateDestinationComment($request->post());
            return $this->asJson($saved);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionGetReview() {
        $request = Yii::$app->request;

        if($request->isPost) {
            $id = $request->post('id');

            $comments = DestinationService::GetCommentListByPlaceId($id);
            $rating = DestinationService::GetRatingByPlaceId($id);

            $response = [
                'status' => true,
                'review' => [
                    'comments' => $comments,
                    'rating' => $rating
                ]
            ];
            return $this->asJson($response);
        }

        throw new \yii\web\NotFoundHttpException();
    }
}