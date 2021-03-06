<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;


class SoftDeleteAction extends BaseAction
{
    public function run($id)
    {
        /* @var $article \app\modules\blog\models\Article */
        $article = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->canHideArticle($article)){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }

        if($article->status == Article::STATUS_DELETED){
            Yii::$app->session->setFlash('error', Module::t('blog', 'Article already was deleted'));
            return $this->controller->redirect('/admin/blog/category/index');
        }
        $article->status = Article::STATUS_DELETED;
        if(!$article->save()) {
            Yii::$app->session->setFlash('error', Module::t('blog', 'Something went wrong'));
            return $this->controller->redirect('/admin/blog/category/index');
        }
        Yii::$app->session->setFlash('success', Module::t('blog', 'Soft delete successful'));
        return $this->controller->redirect(Yii::$app->request->referrer ?: '/admin/blog/category/index');
    }
}