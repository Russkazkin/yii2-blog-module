<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\Module;
use yii\web\UnauthorizedHttpException;

class DeleteAction extends BaseAction
{
    public function beforeRun()
    {
        if(!$this->controller->rbacManager->haveAdminPermissions()){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }
        return parent::beforeRun();
    }

    public function run($id)
    {
        $this->controller->findModel($id)->delete();

        return $this->controller->redirect(['index']);
    }
}