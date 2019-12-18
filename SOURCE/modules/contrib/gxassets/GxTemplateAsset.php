<?php
namespace app\modules\contrib\gxassets;

class GxTemplateAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/template';

    public $css = [
        'css/animate.css',
        'https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900',
        'css/icons/icomoon/styles.css',
        'css/icons/fontawesome/styles.min.css',
        'css/bootstrap_limitless.min.css',
        'css/components.min.css',
        'css/layout.min.css',
        'css/colors.min.css',
        'css/custom-style.css'
    ];

    public $js = [
        'js/wow.min.js',
        'js/core/app.js'
    ];

    public $depends = [
        '\app\modules\contrib\gxassets\GxBootstrapAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}