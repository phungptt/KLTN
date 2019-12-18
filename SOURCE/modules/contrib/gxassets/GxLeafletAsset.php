<?php
namespace app\modules\contrib\gxassets;

class GxLeafletAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/leaflet';

    public $css = [
        'leaflet.css'
    ];

    public $js = [
        'leaflet.js'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}