<?php

namespace app\modules\app;


class APPConfig
{
    public static $CONFIG = [
        'siteName' => 'DAILYLIST',
    ];

    public static $ROOT_URL = 'app/';
    public static $URL_KEY = 'dailylist2019';

    public static function getUrl($url)
    {
        return \Yii::$app->homeUrl . self::$ROOT_URL . $url;
    }
}