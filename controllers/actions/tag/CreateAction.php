<?php


namespace app\modules\blog\controllers\actions\tag;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Tag;
use app\modules\blog\Module;
use Yii;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use yii\widgets\ActiveForm;

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

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            If ($model->save()) {
                Yii::$app->session->setFlash('success', Module::t('blog', 'Tag {name} created'), ['name' => $model->title]);
                return $this->controller->redirect(['index']);
            }
        }

        return $this->controller->render('create', [
            'model' => $model,
        ]);
    }
}