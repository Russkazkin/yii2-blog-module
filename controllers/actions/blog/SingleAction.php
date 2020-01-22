<?php


namespace app\modules\blog\controllers\actions\blog;

use app\modules\blog\models\Article;
use yii\data\Pagination;

class SingleAction extends BaseBlogAction
{
    public function run($id)
    {
        /**
         * @var $model Article
         */
        $model = $this->controller->findModel($id);
        $this->controller->articleComponent->addViewsCount($model);
        $query = Article::find()
            ->where(['status' => 10, 'user_id' => $model->user_id])
            ->orderBy(['date' => SORT_DESC])
            ->with(['user', 'category']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $authorItems = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $related = Article::find()
            ->where(['status' => 10, 'category_id' => $model->category_id])
            ->orderBy(['date' => SORT_DESC])
            ->all();
        return $this->controller->render('single', [
            'model' => $model,
            'tags' => $model->getTags()->all(),
            'sidebarData' => $this->getSidebarData(),
            'dateManager' => $this->controller->dateManager,
            'articleComponent' => $this->controller->articleComponent,
            'pages' => $pages,
            'authorItems' => $authorItems,
            'related' => $related,
            'comments' => $model->comments,
            'commentsCount' => $model->getComments()->count(),
        ]);
    }
}