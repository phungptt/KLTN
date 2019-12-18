<?php
namespace app\modules\contrib\gxassets;

use yii\web\JqueryAsset;


class GxJqueryAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/jquery';

    public $css = [
    ];

    public $js = [
       'jquery.min.js',
    ];

    public $depends = [
        //'yii\web\JqueryAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}