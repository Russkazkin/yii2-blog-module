<?php


namespace app\modules\blog\components;


use app\modules\blog\models\Article;
use app\modules\blog\models\Category;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

class ArticleComponent extends BaseObject
{
    public function getImage(Article $article)
    {
        return $article->image ? '/blog_uploads/' . $article->image : '/img/placeholder.jpg';
    }

    public function getDescription(Article $article)
    {
        return $article->description ?: StringHelper::truncate(strip_tags($article->content), '128');
    }

    public function addViewsCount(Article $article)
    {
        if(!$article->viewed) {
            $article->viewed = 1;
        } else {
            $article->viewed++;
        }
        return $article->save();
    }

    public function getCategoriesList()
    {
        return ArrayHelper::map(Category::find()->where(['status' => Category::STATUS_ACTIVE])->all(), 'id', 'title');
    }
}