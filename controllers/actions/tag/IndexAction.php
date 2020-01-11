<?php


namespace app\modules\blog\controllers\actions\tag;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Tag;
use app\modules\blog\Module;
use Yii;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use yii\widgets\ActiveForm;

class IndexAction extends BaseAction
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
        $tags = Tag::find()->all();
        $model = new Tag();

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Module::t('blog', 'Tag creation successful'));
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->controller->render('index', [
            'tags' => $tags,
            'rbacManager' => $this->controller->rbacManager,
            'model' => $model,
        ]);
    }
}