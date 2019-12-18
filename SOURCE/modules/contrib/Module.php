<?php
/**
 * Description of Module
 *
 * @author admin
 */
namespace app\modules\contrib;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        $this->modules = [
            'auth' => [
                'class' => 'app\modules\contrib\auth\Module'
            ],
            'helper' => [
                'class' => 'app\modules\contrib\helper\Module'
            ],
            'gxassets' => [
                'class' => 'app\modules\contrib\gxassets\Module'
            ]
        ];
    }
}