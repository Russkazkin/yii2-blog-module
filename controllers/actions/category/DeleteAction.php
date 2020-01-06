<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use Yii;

class DeleteAction extends BaseAction
{
    public function run($id)
    {
        $this->controller->findModel($id)->delete();
        return $this->controller->redirect(['index']);
    }
}