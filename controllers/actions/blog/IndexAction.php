<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use yii\data\Pagination;

class IndexAction extends BaseAction
{
    public function run()
    {
        $query = Article::find()->where(['status' => 10])->orderBy(['date' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->controller->render('index', [
            'models' => $models,
            'pages' => $pages,
            'dateManager' => $this->controller->dateManager,
        ]);
    }
}