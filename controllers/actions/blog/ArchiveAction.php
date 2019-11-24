<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\controllers\actions\BaseAction;

class ArchiveAction extends BaseBlogAction
{
    public function run()
    {
        return $this->controller->render('archive', [
            'dateManager' => $this->controller->dateManager,
            'sidebarData' => $this->getSidebarData(),
        ]);
    }
}