<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\auth\models\User;
use app\modules\blog\models\Article;
use app\modules\blog\models\Category;
use app\modules\blog\Module;
use Yii;
use yii\web\NotFoundHttpException;

class AuthorAction extends BaseBlogAction
{
    public function run($id)
    {
        $query = Article::find()
            ->andWhere(['user_id' => $id])
            ->andWhere(['status' => 10])
            ->orderBy(['date' => SORT_DESC]);

        $name = User::find()
            ->where(['id' => $id])
            ->one()
            ->name;
        $title = Module::t('blog', '{name} Blog', ['name' => $name]);

        if(!$query->all()){
            throw new NotFoundHttpException(Yii::t('blog', 'This author has no articles.'));
        }

        return self::renderArticlesList($query, $title);
    }
}