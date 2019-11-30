<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\models\Tag;
use Yii;
use yii\web\NotFoundHttpException;

class TagAction extends BaseBlogAction
{
    public function run($id)
    {
        $tag = Tag::find()->where(['id' => $id])->one();
        if(!$tag) {
            throw new NotFoundHttpException(Yii::t('blog', 'No articles with this tag found.'));
        }
        $query = $tag->getArticles();
        return self::renderArticlesList($query);
    }
}