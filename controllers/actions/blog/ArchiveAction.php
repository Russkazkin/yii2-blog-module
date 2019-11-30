<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\models\Article;
use Yii;
use yii\web\NotFoundHttpException;

class ArchiveAction extends BaseBlogAction
{
    public function run($id)
    {
        $query = Article::find()
            ->andWhere(['category_id' => $id])
            ->andWhere(['status' => 10])
            ->orderBy(['date' => SORT_DESC]);

        if(!$query->all()){
            throw new NotFoundHttpException(Yii::t('blog', 'There are no posts in this category yet.'));
        }
        return self::renderArticlesList($query);
    }
}