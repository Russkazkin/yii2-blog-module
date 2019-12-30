<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use yii\web\UnauthorizedHttpException;

class ViewAction extends BaseAction
{
    public function run($id)
    {
        $model = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->canViewArticle($model)){
            throw new UnauthorizedHttpException('You can\'t view this article');
        }
        return $this->controller->render('view', [
            'model' => $model,
            'articleComponent' => $this->controller->articleComponent,
            'rbacManager' => $this->controller->rbacManager,
        ]);
    }
}