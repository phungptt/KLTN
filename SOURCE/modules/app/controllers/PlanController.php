<?php

namespace app\modules\app\controllers;

use app\modules\app\APPConfig;
use app\modules\app\models\Plan;
use app\modules\app\services\DestinationService;
use app\modules\app\services\PlanService;
use Yii;
use yii\web\Controller;

class PlanController extends Controller
{
     public function actionCreatePlan() {
          $model = new Plan();
          $destinations = DestinationService::GetArrayDestination();
          $request =  Yii::$app->request;

          if($request->isPost) {
               $model = PlanService::CreatePlan($request->post());

               if($model) {
                    Yii::$app->session->setFlash('success', 'Tạo mới lịch trình thành công');
                    return $this->redirect(APPConfig::getUrl('plan/create-plan-detail?slug=' . $model->slug));
               } else {
                    $response = [
                         'status' => false,
                         'message' => 'Có lỗi sảy ra, vui lòng thử lại'
                    ];
                    
                    return $this->asJson($response);
               }
          }
          return $this->render('create-plan', compact('destinations', 'model'));
     }

     public function actionCreatePlanDetail($slug = null) {
          $plan = PlanService::GetPlanBySlug($slug);
          return $this->render('create-plan-detail', compact('plan'));
     }

     public function actionPlanTripDetail() {
          return $this->render('plan-trip-detail');
     }

     public function actionPlanList() {
          return $this->render('plan-list');
     }
}