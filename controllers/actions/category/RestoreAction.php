<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;

class RestoreAction extends BaseAction
{
    public function run($id)
    {
        /* @var $model \app\modules\blog\models\Category */
        $model = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->haveEditorPermissions()){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }

        if($model->status == Category::STATUS_ACTIVE){
            Yii::$app->session->setFlash('error', Module::t('blog', 'Category already active'));
            return $this->controller->redirect('/admin/blog/category/index');
        }
        $model->status = Category::STATUS_ACTIVE;
        if(!$model->save()) {
            Yii::$app->session->setFlash('error', Module::t('blog', 'Something went wrong'));
            return $this->controller->redirect('/admin/blog/category/index');
        }
        Yii::$app->session->setFlash('success', Module::t('blog', 'Restore successful'));
        return $this->controller->redirect(Yii::$app->request->referrer ?: '/admin/blog/category/index');
    }
}