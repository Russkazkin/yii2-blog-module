<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;
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
        $categories = Category::find()->all();
        $model = new Category();

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Module::t('blog', 'Category creation successful'));
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->controller->render('index', [
            'categories' => $categories,
            'rbacManager' => $this->controller->rbacManager,
            'model' => $model,
        ]);
    }
}