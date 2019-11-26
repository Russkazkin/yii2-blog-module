<?php


namespace app\modules\blog\models;


use app\modules\blog\models\base\BaseArticleTag;
use yii\base\InvalidConfigException;

class ArticleTag extends BaseArticleTag
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        try {
            return $this->hasMany(Article::class, ['id' => 'article_id'])
                ->viaTable('blog_article_tag', ['tag_id' => 'id']);
        } catch (InvalidConfigException $e) {
            die($e->getMessage()); //TODO Add user friendly error
        }
    }
}