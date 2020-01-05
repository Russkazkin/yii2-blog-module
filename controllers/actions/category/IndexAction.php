<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;
use app\modules\blog\Module;
use Yii;

class IndexAction extends BaseAction
{
    public function run()
    {
        $categories = Category::find()->all();
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Module::t('blog', 'Category creation successful'));
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('index', [
            'categories' => $categories,
            'rbacManager' => $this->controller->rbacManager,
            'model' => $model,
        ]);
    }
}