<?php
namespace app\modules\contrib\gxassets;

// use yii\bootstrap\BootstrapAsset;


class GxSwiperAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/swiper';

    public $css = [
        'swiper.css',
    ];

    public $js = [
        'vue-awesome-swiper.js',
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxVueAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}