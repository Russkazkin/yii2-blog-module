<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;

class IndexAction extends BaseAction
{
    public function run()
    {
        $articles = Article::find()->with(['category', 'tags'])->all();

        return $this->controller->render('index', [
            'articles' => $articles,
            'articleComponent' => $this->controller->articleComponent,
            'rbacManager' => $this->controller->rbacManager,
        ]);
    }
}