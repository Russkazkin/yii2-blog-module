<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use Yii;

class DeleteAction extends BaseAction
{
    public function run($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::warning('ajax');
            return true;
            /*Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['data' => 'ok'];*/
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}