<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15-Mar-19
 * Time: 7:51 AM
 */

namespace app\modules\contrib\widgets;

use yii\base\Widget;

class ModalWidget extends Widget
{
    public $title;
    public $id;

    public function run() {
        return $this->render('modalWidget', [
            'title' => $this->title,
            'id' => $this->id,
        ]);
    }
}