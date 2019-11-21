<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;

class BaseBlogAction extends BaseAction
{
    public $popularArticles;

    public function init()
    {
        parent::init();

        $this->popularArticles = Article::find()->orderBy('viewed desc')->limit(3)->all();
    }
}