<?php
/**
 * Description of Module
 *
 * @author admin
 */
namespace app\modules\app;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        $this->modules = [
            'widgets' => [
                'class' => 'app\modules\app\widgets\Module'
            ]
        ];
    }
}