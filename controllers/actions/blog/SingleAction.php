<?php


namespace app\modules\blog\controllers\actions\blog;

class SingleAction extends BaseBlogAction
{
    public function run($id)
    {
        return $this->controller->render('single', [
            'model' => $this->controller->findModel($id),
            'sidebarData' => $this->getSidebarData(),
            'dateManager' => $this->controller->dateManager,
        ]);
    }
}