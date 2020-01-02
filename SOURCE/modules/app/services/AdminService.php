<?php 

namespace app\modules\app\services;

use app\modules\app\services\ImageService;
use app\modules\contrib\helper\ConvertHelper;
use Yii;
use app\modules\app\APPConfig;
use app\modules\app\models\Place;

class AdminService
{
    public static $AVALABLE = 1;
    public static $PENDING = 0;

    public static $DELETED = 1;
    public static $ALIVE = 0;

    public static function GetPlaceList() {
        $places = Place::find()->where(['deleted' => self::$ALIVE])->asArray()->all();
        return $places;
    }
}