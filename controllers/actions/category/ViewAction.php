<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;

class ViewAction extends BaseAction
{
    public function run($id)
    {
        return $this->controller->render('view', [
            'model' => $this->controller->findModel($id),
            'rbacManager' => $this->controller->rbacManager,
        ]);
    }
}