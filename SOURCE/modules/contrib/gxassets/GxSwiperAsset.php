<?php
namespace app\modules\contrib\gxassets;

// use yii\bootstrap\BootstrapAsset;


class GxSwiperAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/swiper';

    public $css = [
        'swiper.min.css',
    ];

    public $js = [
        'swiper.min.js',
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxJqueryAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}