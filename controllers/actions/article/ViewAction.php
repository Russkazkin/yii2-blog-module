<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;

class ViewAction extends BaseAction
{
    public function run($id)
    {
        return $this->controller->render('view', [
            'model' => $this->controller->findModel($id),
            'articleComponent' => $this->controller->articleComponent,
        ]);
    }
}