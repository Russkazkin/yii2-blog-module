<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\Module;
use yii\web\UnauthorizedHttpException;

class ViewAction extends BaseAction
{
    public function run($id)
    {
        $model = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->canViewArticle($model)){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }
        return $this->controller->render('view', [
            'model' => $model,
            'articleComponent' => $this->controller->articleComponent,
            'rbacManager' => $this->controller->rbacManager,
        ]);
    }
}