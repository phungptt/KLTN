<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15-Mar-19
 * Time: 8:05 AM
 */

namespace app\modules\app\widgets;

use yii\base\Widget;

class CMSMapPlanWidget extends Widget
{
     public function run()
     {
          return $this->render('cmsMapPlanWidget');
     }
}
