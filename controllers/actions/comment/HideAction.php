<?php


namespace app\modules\blog\controllers\actions\comment;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Comment;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;

class HideAction extends BaseAction
{
    public function run($id)
    {
        /* @var $model \app\modules\blog\models\Comment */
        $model = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->haveEditorPermissions()){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }

        if($model->status == Comment::STATUS_DELETED){
            Yii::$app->session->setFlash('error', Module::t('blog', 'Comment is hidden already'));
            return $this->controller->redirect('/admin/blog/comment/index');
        }
        $model->status = Comment::STATUS_DELETED;
        if(!$model->save()) {
            Yii::$app->session->setFlash('error', Module::t('blog', 'Something went wrong'));
            return $this->controller->redirect('/admin/blog/comment/index');
        }
        Yii::$app->session->setFlash('success', Module::t('blog', 'Hide was successful'));
        return $this->controller->redirect(Yii::$app->request->referrer ?: '/admin/blog/comment/index');
    }
}