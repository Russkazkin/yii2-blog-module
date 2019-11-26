<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\models\Article;
use yii\data\Pagination;

class ArchiveAction extends BaseBlogAction
{
    public function run($category_id = null, $tag_id = null)
    {
        if(isset($category_id)) {
            $query = Article::find()
                ->andWhere(['category_id' => $category_id])
                ->andWhere(['status' => 10])
                ->orderBy(['date' => SORT_DESC]);
        } elseif (isset($tag_id)) {
            echo 'it\'s tag';
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->controller->render('archive', [
            'models' => $models,
            'pages' => $pages,
            'dateManager' => $this->controller->dateManager,
            'sidebarData' => $this->getSidebarData(),
        ]);
    }
}