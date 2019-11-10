<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\controllers\actions\BaseAction;

class IndexAction extends BaseAction
{
    public function run()
    {
        return $this->controller->render('index');
    }
}