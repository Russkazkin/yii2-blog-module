<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use yii\web\UnauthorizedHttpException;

class DeleteAction extends BaseAction
{
    public function run($id)
    {
        //TODO: Add image removal before article delete
        $model = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->canDeleteArticle($model)){
            throw new UnauthorizedHttpException('You can\'t delete this article');
        }

        $model->delete();

        return $this->controller->redirect(['index']);
    }
}