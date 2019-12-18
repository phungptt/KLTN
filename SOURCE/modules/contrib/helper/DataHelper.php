<?php
/**
 * Description of Module
 *
 * @author TriLVH
 */
namespace app\modules\contrib\helper;

use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class DataHelper {
    public static function getPaginationResponse($query, $limit) {
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $limit = isset($limit) ? $limit : $pages->limit;
        $models = $query->offset($pages->offset)->limit($limit);
        return ['pages' => $pages, 'models' => $models];
    }

    public static function initJsonResponse() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public static function getArrayFromObjects($models) {
        $result = [];
        if (isset($models) && !empty($models)) {
            foreach ($models as $model) {
                $array = ArrayHelper::toArray($model);
                array_push($result, $array);
            }
        }
        return $result;
    }
}