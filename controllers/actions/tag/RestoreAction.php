<?php


namespace app\modules\blog\controllers\actions\tag;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;
use app\modules\blog\models\Tag;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;

class RestoreAction extends BaseAction
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
        /* @var $model \app\modules\blog\models\Tag */
        $model = $this->controller->findModel($id);

        if($model->status == Tag::STATUS_ACTIVE){
            Yii::$app->session->setFlash('error', Module::t('blog', 'Tag already active'));
            return $this->controller->redirect('/admin/blog/tag/index');
        }
        $model->status = Tag::STATUS_ACTIVE;
        if(!$model->save()) {
            Yii::$app->session->setFlash('error', Module::t('blog', 'Something went wrong'));
            return $this->controller->redirect('/admin/blog/tag/index');
        }
        Yii::$app->session->setFlash('success', Module::t('blog', 'Restore successful'));
        return $this->controller->redirect(Yii::$app->request->referrer ?: '/admin/tag/category/index');
    }
}