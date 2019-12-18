<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;

class SoftDeleteAction extends BaseAction
{
    public function run($id)
    {
        var_dump($id);
    }
}