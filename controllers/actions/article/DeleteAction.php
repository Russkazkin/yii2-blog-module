<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\Module;
use yii\web\UnauthorizedHttpException;

class DeleteAction extends BaseAction
{
    public function run($id)
    {
        //TODO: Add image removal before article delete
        $model = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->canDeleteArticle($model)){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }

        $model->delete();

        return $this->controller->redirect(['index']);
    }
}