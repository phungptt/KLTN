<?php
namespace app\modules\contrib\gxassets;

class GxSelect2Asset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/select2';

    public $css = [
        'select2.min.css'
    ];

    public $js = [
        'select2.min.js'
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxJqueryAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}