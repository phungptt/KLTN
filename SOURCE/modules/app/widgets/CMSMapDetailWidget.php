<?php

namespace app\modules\app\widgets;

use yii\base\Widget;

class CMSMapDetailWidget extends Widget
{
    public $lat;
    public $lng;

    public function run()
    {
        $lat = $this->lat ? $this->lat : null;
        $lng = $this->lng ? $this->lng : null;
        return $this->render('cmsMapDetailWidget', compact('lat', 'lng'));
    }

}