<?php

namespace app\modules\app\services;

use app\modules\app\models\Plan;
use app\modules\app\models\PlanDetail;
use Yii;
use yii\db\Query;

class PlanService
{
    public static $AVALABLE = 1;
    public static $PENDING = 0;

    public static $PUBLIC = 1;
    public static $PRIVATE = 0;

    public static $DELETED = 1;
    public static $ALIVE = 0;

    public static $HERE_ID = 'gRqLa6YYLXTqvoTTUhiT';
    public static $HERE_KEY = 'hPtC4kp3SDaqlFsNbcT_zPpyknvCfWEdcxejzcUk8zI';

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

    public static function SavePlanDetails($trip, $planid = null) {
        $transaction = Yii::$app->db->beginTransaction();
        try{
            //duplicate
            $plan = $planid ? Plan::findOne($planid) : self::DuplicatePlan($planid);
            self::DeleteAllPlanDetail($planid);
            $planid = $plan->id;
            $flag = true;
            foreach($trip as &$date) {
                foreach($date['details'] as $place) {
                    $plan_detail = new PlanDetail();
                    $plan_detail->id_plan = $planid;
                    $plan_detail->id_place = (int)$place['id_place'];
                    $plan_detail->place_name = $place['place_name'];
                    $plan_detail->time_start = (int)$place['time_start'];
                    $plan_detail->time_stay = (int)$place['time_stay'];
                    $plan_detail->free_time = (int)$place['free_time'];
                    $plan_detail->time_move = (int)$place['time_move'];
                    $plan_detail->distance = (float)$place['distance'];
                    $plan_detail->id_type_of_transport = (int)$place['id_type_of_transport'];
                    $plan_detail->note = $place['note'];
                    $plan_detail->date_index = (int)$place['date_index'];
                    $plan_detail->path = $place['path'];
                    $plan_detail->slug = $place['slug'];
                    $plan_detail->lat = $place['lat'];
                    $plan_detail->lng = $place['lng'];
                    if(!($flag = $plan_detail->save(false))) {
                        $transaction->rollBack();
                        break;
                    }
                }
            }

            if($flag) {
                $plan->route_json = json_encode($trip, true);
                if($plan->save()) {
                    $transaction->commit();
                    return $plan->slug;
                }
            }
            
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        return false;
    }

    public static function DeleteAllplanDetail($planid) {
        PlanDetail::deleteAll(['id_plan' => $planid]);
    }

    public static function IsCurrentUserOwnedPlan($id) {
        $userid = Yii::$app->user->id;
        $plan = Plan::findOne($id);
        if($plan) {
            if($plan->created_by == $userid) {
                return true;
            }
        }
        return false;
    }

    public static function DuplicatePlan($id) {
        $oldPlan = Plan::findOne($id);
        $newPlan = new Plan();

        $newPlan->setAttributes($oldPlan->attributes);
        $newPlan->created_by = Yii::$app->user->id;
        $newPlan->slug = SiteService::uniqid();
        $newPlan->save();

        return $newPlan;
    }

    public static function GetPlacesOfPlan($planid) {
        $places = PlanDetail::find(['id_plan' => $planid])->asArray()->all();
        $placesGroup = [];
        foreach($places as $place) {
            if(!isset($placesGroup[$place['date_index']])) {
                $placesGroup[$place['date_index']] = [];
            }

            array_push($placesGroup[$place['date_index']], $place);
        }
        
        return $placesGroup;
    }

    public static function GetPlanList() {
        $query = (new Query())
                                    -> select([
                                        'plan.slug as plan_slug',
                                        'plan.id_destination',
                                        'plan.total_day',
                                        'des.path as des_path',
                                        'des.name as des_name',
                                        'u.fullname as fullname'
                                    ])
                                    ->from('plan')
                                    ->innerJoin('user_info as u','u.user_id = plan.created_by')
                                    ->innerJoin('destination_image as des','des.id = plan.id_destination')
                                    ->all();

        $plan = [];

        foreach($query as &$q) {
            if(!isset($plan[$q['id_destination']])) {
                $q['des_path'] = ImageService::GetThumbnailPath($q['des_path']);
                $plan[$q['id_destination']] = $q;
            }
        }
        return $plan;
    }
}
