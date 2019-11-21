<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use app\modules\blog\models\Category;

class BaseBlogAction extends BaseAction
{
    public $popularArticles;
    public $recentArticles;

    public function init()
    {
        parent::init();

        $this->popularArticles = Article::find()->orderBy('viewed desc')->limit(3)->all();
        $this->recentArticles = Article::find()->orderBy('date desc')->limit(4)->all();
    }

    public function getCategoriesList()
    {
        return Category::find()->all();
    }
}