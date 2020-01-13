<?php 

namespace app\modules\api\controllers;

use app\modules\app\services\PlaceService;
use app\modules\app\models\Comment;
use app\modules\app\models\Rating;
use Yii;
use yii\web\Controller;

class PlaceController extends Controller
{
    public $enableCsrfValidation = false;
    
    public function actionGetPlaceList() {
        $request = Yii::$app->request;
        if($request->isPost) {
            $destination = $request->post('destination');
            $type = $request->post('type');
            $page = $request->post('page');
            $keyword = $request->post('keyword');
            $lat = $request->post('lat');
            $lng = $request->post('lng');
    
            list($places, $paginations) = PlaceService::GetPlaceListWithPaginations($destination, $type, $page, $keyword, $lat, $lng);
            $response = [
                'status' => true,
                'places' => [
                    'data' => $places,
                    'paginations' => $paginations
                ]
            ];

            return $this->asJson($response);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionGetPlaceLocation() {
        $request = Yii::$app->request;
        if($request->isPost) {
            $keyword = $request->post('keyword');
            $type = $request->post('type');

            $location = PlaceService::GetLocationAvailable($type, $keyword);

            $response = [
                'status' => true,
                'places' => [
                    'data' => $location
                ]
            ];

            return $this->asJson($response);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionCreateComment() {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $saved = PlaceService::CreatePlaceComment($request->post());
            return $this->asJson($saved);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionGetReview() {
        $request = Yii::$app->request;

        if($request->isPost) {
            $id = $request->post('id');

            $comments = PlaceService::GetCommentListByPlaceId($id);
            $rating = PlaceService::GetRatingByPlaceId($id);

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