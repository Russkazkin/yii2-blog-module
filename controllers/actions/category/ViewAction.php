<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\Module;
use yii\web\UnauthorizedHttpException;

class ViewAction extends BaseAction
{
    public function beforeRun()
    {
        if(!$this->controller->rbacManager->haveEditorPermissions()){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }
        return parent::beforeRun();
    }

    public function run($id)
    {
        return $this->controller->render('view', [
            'model' => $this->controller->findModel($id),
            'rbacManager' => $this->controller->rbacManager,
        ]);
    }
}