<?php


namespace app\modules\blog\components;


use app\modules\blog\models\Article;
use yii\base\BaseObject;
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
}