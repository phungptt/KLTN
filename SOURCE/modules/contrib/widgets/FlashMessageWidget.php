<?php
 namespace app\modules\contrib\widgets;

use yii\base\Widget;

class FlashMessageWidget extends Widget {
     public function run() {
         return $this->render('flashMessageWidget');
     }
 }