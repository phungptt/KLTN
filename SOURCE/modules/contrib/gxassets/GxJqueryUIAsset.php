<?php
namespace app\modules\contrib\gxassets;

class GxJqueryUIAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/jquery_ui';

    public $css = [
    ];

    public $js = [
        'jquery-ui.min.js',
        'widgets.min.js',
        'jquery.layout-latest.js'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}