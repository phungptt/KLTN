<?php
namespace app\modules\contrib\gxassets;

class GxPickerJsAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/pickerjs';

    public $css = [
        'picker.css'
    ];

    public $js = [
        'picker.js'
    ];


    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}