<?php

namespace app\modules\app\widgets;

use yii\base\Widget;


class CMSDevicesMapWidget extends Widget {
    public function init() {
        parent::init();
    }

    public function run() {
        return $this->render('cmsDevicesMapWidget');
    }
}