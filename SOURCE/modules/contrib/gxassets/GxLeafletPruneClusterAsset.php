<?php
namespace app\modules\contrib\gxassets;

class GxLeafletPruneClusterAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@app/modules/contrib/gxassets/assets/leaflet-plugins/prunecluster';

    public $css = [
        'LeafletStyleSheet.css'
    ];

    public $js = [
        'PruneCluster.js'
    ];

    public $depends = [
        '\app\modules\contrib\gxassets\GxLeafletAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}