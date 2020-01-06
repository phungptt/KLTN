<?php

namespace app\modules\api;


class APIConfig
{

    public static $ROOT_URL = 'api/';
    public static $URL_KEY = 'dailylist2019';

    public static function getUrl($url)
    {
        return \Yii::$app->homeUrl . self::$ROOT_URL . $url;
    }
}