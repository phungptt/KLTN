<?php
namespace app\modules\contrib\gxassets;

class GxErsiAutocompleteAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/esri-autocomplete';

    public $css = [
        'esri-leaflet-geocoder.css'
    ];

    public $js = [
        'esri-leaflet.js',
        'esri-leaflet-geocoder.js'
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxLeafletAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}