<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\controllers\actions\BaseAction;

class SingleAction extends BaseAction
{
    public function run()
    {
        return $this->controller->render('single');
    }
}