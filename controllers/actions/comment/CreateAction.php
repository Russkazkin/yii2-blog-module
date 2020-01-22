<?php


namespace app\modules\blog\controllers\actions\comment;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Comment;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Yii;
use yii\web\ServerErrorHttpException;

class CreateAction extends BaseAction
{
    public function run($id)
    {
        $model = new Comment();
        $model->load(Yii::$app->request->post());
        $model->article_id = $id;

        if ($model->save()) {
            return $this->controller->redirect(['/', 'id' => $model->id]);
        }
        throw new ServerErrorHttpException('Comment is not saved');
    }
}