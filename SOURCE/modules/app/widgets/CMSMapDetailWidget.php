<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15-Mar-19
 * Time: 8:05 AM
 */

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