<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\auth\components\RbacComponent;
use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;

class SoftDeleteAction extends BaseAction
{
    public function run($id)
    {
        /** @var $model \app\modules\blog\modells\Category
         * @var $manager RbacComponent
         */
        $model = $this->controller->findModel($id);
        $manager = $this->controller->rbacManager;

        if (!$manager->haveEditorPermissions()){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }

        if($model->status == Category::STATUS_DELETED){
            Yii::$app->session->setFlash('error', Module::t('blog', 'Category already was deleted'));
            return $this->controller->redirect('/admin/blog/category/index');
        }
        $model->status = Category::STATUS_DELETED;
        if(!$model->save()) {
            Yii::$app->session->setFlash('error', Module::t('blog', 'Something went wrong'));
            return $this->controller->redirect('/admin/blog/category/index');
        }
        Yii::$app->session->setFlash('success', Module::t('blog', 'Soft delete successful'));
        return $this->controller->redirect(Yii::$app->request->referrer ?: '/admin/blog/category/index');
    }
}