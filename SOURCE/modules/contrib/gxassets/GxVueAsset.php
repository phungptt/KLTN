<?php
namespace app\modules\contrib\gxassets;

class GxVueAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/vue';

    public $css = [
        'custom-vue-style.css',
    ];

    public $js = [
        'vue.js',
        'vue-toast.min.js'
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxJqueryAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}