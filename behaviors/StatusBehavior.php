<?php


namespace app\modules\blog\behaviors;


use app\modules\blog\Module;
use yii\base\Behavior;

class StatusBehavior extends Behavior
{
    public $statusesArr;

    public function init()
    {
        parent::init();
        $this->statusesArr = [
            '0' => Module::t('blog', 'Inactive'),
            '10' => Module::t('blog', 'Active'),
        ];
    }
}

