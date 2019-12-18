<?php

namespace app\modules\app\widgets;

use yii\base\Widget;

class CMSMapEditWidget extends Widget
{
    public $model;
    public $useInputOfWidget;
    public function run()
    {
        return $this->render('cmsMapEditWidget', ['model' => $this->model, 'useInputOfWidget' => $this->useInputOfWidget]);
    }
}
