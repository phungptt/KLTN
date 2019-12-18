<?php
namespace app\modules\contrib\gxassets;

use yii\bootstrap\BootstrapAsset;


class GxBootstrapAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/bootstrap';

    public $css = [
        'bootstrap.min.css',
    ];

    public $js = [
        'bootstrap.min.js',
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxJqueryAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}