<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use app\modules\blog\models\Category;

class BaseBlogAction extends BaseAction
{
    public function getCategoriesList()
    {
        return Category::find()->all();
    }

    public function getPopularArticles()
    {
        return Article::find()->orderBy('viewed desc')->limit(3)->all();
    }

    public function getRecentArticles()
    {
        return Article::find()->orderBy('date desc')->limit(4)->all();
    }
}