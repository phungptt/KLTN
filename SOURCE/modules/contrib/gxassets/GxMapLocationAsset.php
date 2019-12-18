<?php
namespace app\modules\contrib\gxassets;

use yii\web\JqueryAsset;


class GxMapLocationAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/map-location';

    public $css = [
        'control-locate.min.css',
    ];

    public $js = [
       'control-locate.min.js',
    ];

    public $depends = [
        //'yii\web\JqueryAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}