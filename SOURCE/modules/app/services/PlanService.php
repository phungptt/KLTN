<?php

namespace app\modules\app\services;

use app\modules\app\models\Plan;
use Yii;

class PlanService
{
    public static $AVALABLE = 1;
    public static $PENDING = 0;

    public static $PUBLIC = 1;
    public static $PRIVATE = 0;

    public static $DELETED = 1;
    public static $ALIVE = 0;

    public static function CreatePlan($data)
    {
        $model = new Plan();
        $model->load($data);

        $totalDay = self::CalculateTotalDayFromStartAndEnd($model->date_start, $model->date_end);
        $model->slug = SiteService::uniqid();
        $model->status = self::$AVALABLE;
        $model->public = self::$PUBLIC;
        $model->deleted = self::$ALIVE;
        $model->name = self::GeneratePlanName($model->id_destination, $totalDay);
        $model->total_day = $totalDay;
        $model->created_by = Yii::$app->user->id;
        $model->date_start = date("Y-m-d", strtotime($model->date_start));
        $model->date_end = date("Y-m-d", strtotime($model->date_end));
        
        if($model->save()) {
            return $model;
        }

        return false;
    }

    public static function CalculateTotalDayFromStartAndEnd($date_start, $date_end)
    {
        $diff = abs(strtotime($date_end) - strtotime($date_start));
        $totalDay = $diff / (60 * 60 * 24) + 1;
        return $totalDay;
    }

    public static function GeneratePlanName($destId, $totalDay) {
        $destName = DestinationService::GetDestinationNameById($destId);
        $planName =  'Lịch trình ' . $totalDay . ' ngày tại ' . $destName;
        return $planName;
    }

    public static function GetPlanBySlug($slug) {
        $plan = Plan::find()->where(['slug' => $slug])->andWhere(['and', ['status' => self::$AVALABLE], ['deleted' => self::$ALIVE]])->asArray()->one();
        return $plan;
    }
}
