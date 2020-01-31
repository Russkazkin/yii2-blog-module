<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\models\Tag;
use app\modules\blog\Module;
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
        $title = Module::t('blog', 'Tag {name}', ['name' => $tag->title]);
        return self::renderArticlesList($query, $title);
    }
}