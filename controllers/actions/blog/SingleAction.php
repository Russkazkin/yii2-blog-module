<?php


namespace app\modules\blog\controllers\actions\blog;

/* @var $model \app\modules\blog\models\Article */

class SingleAction extends BaseBlogAction
{
    public function run($id)
    {
        $model = $this->controller->findModel($id);
        return $this->controller->render('single', [
            'model' => $model,
            'tags' => $model->getTags()->all(),
            'sidebarData' => $this->getSidebarData(),
            'dateManager' => $this->controller->dateManager,
        ]);
    }
}