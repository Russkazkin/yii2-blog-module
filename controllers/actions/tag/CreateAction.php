<?php


namespace app\modules\blog\controllers\actions\tag;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Tag;
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
        $model = new Tag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('create', [
            'model' => $model,
        ]);
    }
}