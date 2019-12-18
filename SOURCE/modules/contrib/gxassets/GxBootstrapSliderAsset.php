<?php
namespace app\modules\contrib\gxassets;

class GxBootstrapSliderAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/bootstrap-slider';

    public $css = [
         'bootstrap-slider.min.css'
    ];

    public $js = [
        'bootstrap-slider.js'
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxJqueryAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}