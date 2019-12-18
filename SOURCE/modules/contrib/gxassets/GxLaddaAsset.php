<?php
namespace app\modules\contrib\gxassets;

class GxLaddaAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/ladda';

    public $css = [
        'ladda.min.css'
    ];

    public $js = [
        'spin.min.js',
        'ladda.min.js',
    ];

    public $depends = [
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}