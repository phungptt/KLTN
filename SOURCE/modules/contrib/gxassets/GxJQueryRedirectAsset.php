<?php
namespace app\modules\contrib\gxassets;

class GxJQueryRedirectAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/jquery-redirect';

    public $css = [
    ];

    public $js = [
        'jquery-redirect.js'
    ];

    public $depends = [
        '\app\modules\contrib\gxassets\GxJqueryAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}