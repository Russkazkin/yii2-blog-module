<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\models\Article;
use yii\data\Pagination;

class IndexAction extends BaseBlogAction
{
    public function run()
    {
        $query = Article::find()->where(['status' => 10])->orderBy(['date' => SORT_DESC])->with(['user', 'category']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->controller->render('index', [
            'models' => $models,
            'pages' => $pages,
            'dateManager' => $this->controller->dateManager,
            'sidebarData' => $this->getSidebarData(),
        ]);
    }
}