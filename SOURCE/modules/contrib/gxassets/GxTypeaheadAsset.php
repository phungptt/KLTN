<?php
namespace app\modules\contrib\gxassets;

use yii\web\JqueryAsset;


class GxTypeaheadAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/typeahead';

    public $css = [
    ];

    public $js = [
       'typeahead.bundle.min.js',
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxJqueryAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}