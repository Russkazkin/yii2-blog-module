<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;
use Yii;

class UpdateAction extends BaseAction
{
    public function run($id)
    {
        /* @var $model Category */
        $model = $this->controller->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('update', [
            'model' => $model,
        ]);
    }
}