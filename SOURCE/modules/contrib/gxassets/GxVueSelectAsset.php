<?php
namespace app\modules\contrib\gxassets;

class GxVueSelectAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/vue-select';

    public $css = [
    ];

    public $js = [
        'vue-select.js'
    ];

    public $depends = [
        '\app\modules\contrib\gxassets\GxVueAsset',
        '\app\modules\contrib\gxassets\GxSelect2Asset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}