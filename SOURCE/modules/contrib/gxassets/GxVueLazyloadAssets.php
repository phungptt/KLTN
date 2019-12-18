<?php
namespace app\modules\contrib\gxassets;

class GxVueLazyloadAssets extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/vue-lazyload';

    public $css = [
    ];

    public $js = [
        'vue-lazyload.js'
    ];

    public $depends = [
        '\app\modules\contrib\gxassets\GxVueAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}