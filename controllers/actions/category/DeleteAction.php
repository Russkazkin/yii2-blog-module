<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use Yii;

class DeleteAction extends BaseAction
{
    public function run($id)
    {
        /*if (Yii::$app->request->isAjax) {
            Yii::warning('ajax');
            return $this->controller->findModel($id)->delete();
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['data' => 'ok'];
        }*/
        $this->controller->findModel($id)->delete();
        //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        //return ['data' => 'ok'];
        return $this->controller->redirect(['index']);
    }
}