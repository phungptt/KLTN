<?php
namespace app\modules\contrib\gxassets;
class GxVueDraggableAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/vue-draggable';
    public $css = [
    ];
    public $js = [
        'Sortable.min.js',
        'vuedraggable.min.js'
    ];
    public $depends = [
        'app\modules\contrib\gxassets\GxVueAsset'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}