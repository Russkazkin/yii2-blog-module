<?php


namespace app\modules\blog\controllers\actions\comment;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Comment;
use Yii;
use yii\web\ServerErrorHttpException;

class CreateAction extends BaseAction
{
    public function run($id)
    {
        $model = new Comment();
        if(!$model->load(Yii::$app->request->post())){
            throw new ServerErrorHttpException('Form data is empty');
        }
        $model->article_id = $id;

        if ($model->save()) {
            return $this->controller->redirect(['/blog/single', 'id' => $id]);
        }
        throw new ServerErrorHttpException('Comment is not saved');
    }
}