<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;

class CreateAction extends BaseAction
{
    public function beforeRun()
    {
        if(!$this->controller->rbacManager->haveEditorPermissions()){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }
        return parent::beforeRun();
    }

    public function run()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Module::t('blog', 'Category creation successful'));
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('create', [
            'model' => $model,
        ]);
    }
}