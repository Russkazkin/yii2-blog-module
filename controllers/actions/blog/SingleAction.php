<?php


namespace app\modules\blog\controllers\actions\blog;

class SingleAction extends BaseBlogAction
{
    public function run()
    {
        return $this->controller->render('single', [
            'sidebarData' => $this->getSidebarData(),
            'dateManager' => $this->controller->dateManager,
        ]);
    }
}