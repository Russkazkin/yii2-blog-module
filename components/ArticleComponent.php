<?php


namespace app\modules\blog\components;


use app\modules\blog\models\Article;
use yii\base\BaseObject;

class ArticleComponent extends BaseObject
{
    public function articleDumper(Article $article)
    {
        die(var_dump($article));
    }
}