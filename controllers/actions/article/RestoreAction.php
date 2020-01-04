<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;

class RestoreAction  extends BaseAction
{
    public function run($id)
    {
        /* @var $article \app\modules\blog\models\Article */
        $article = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->canHideArticle($article)){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }

        if($article->status == Article::STATUS_ACTIVE){
            Yii::$app->session->setFlash('error', Module::t('blog', 'Article already active'));
            return $this->controller->redirect('/admin/blog/article/index');
        }
        $article->status = Article::STATUS_ACTIVE;
        if(!$article->save()) {
            Yii::$app->session->setFlash('error', Module::t('blog', 'Something went wrong'));
            return $this->controller->redirect('/admin/blog/article/index');
        }
        Yii::$app->session->setFlash('success', Module::t('blog', 'Restore successful'));
        return $this->controller->redirect(Yii::$app->request->referrer ?: '/admin/blog/article/index');
    }
}