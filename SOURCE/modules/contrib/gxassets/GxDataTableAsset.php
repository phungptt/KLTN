<?php
namespace app\modules\contrib\gxassets;

class GxDataTableAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/datatables';

    public $css = [
    ];

    public $js = [
        'datatables.min.js',
        'extensions/natural_sort.js',
        'extensions/responsive.min.js',
        'extensions/buttons1-5-2.min.js',
        'buttons.colvis.min.js'
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxJqueryAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}