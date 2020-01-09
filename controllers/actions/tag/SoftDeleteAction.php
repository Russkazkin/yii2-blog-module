<?php


namespace app\modules\blog\controllers\actions\tag;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;
use app\modules\blog\models\Tag;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;

class SoftDeleteAction extends BaseAction
{
    public function beforeRun()
    {
        if(!$this->controller->rbacManager->haveEditorPermissions()){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }
        return parent::beforeRun();
    }

    public function run($id)
    {
        /** @var $model \app\modules\blog\models\Tag
         */
        $model = $this->controller->findModel($id);

        if($model->status == Tag::STATUS_DELETED){
            Yii::$app->session->setFlash('error', Module::t('blog', 'Tag already was deleted'));
            return $this->controller->redirect('/admin/blog/tag/index');
        }
        $model->status = Tag::STATUS_DELETED;
        if(!$model->save()) {
            Yii::$app->session->setFlash('error', Module::t('blog', 'Something went wrong'));
            return $this->controller->redirect('/admin/blog/tag/index');
        }
        Yii::$app->session->setFlash('success', Module::t('blog', 'Soft delete successful'));
        return $this->controller->redirect(Yii::$app->request->referrer ?: '/admin/blog/tag/index');
    }
}