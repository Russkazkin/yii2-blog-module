<?php


namespace app\modules\blog\controllers\actions\blog;

use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use app\modules\blog\models\Category;
use yii\data\Pagination;
use yii\db\ActiveQuery;

class BaseBlogAction extends BaseAction
{
    protected function getSidebarData()
    {
        $data = [];
        $data['popular'] = Article::find()->orderBy('viewed desc')->limit(3)->all();
        $data['recent'] = Article::find()->orderBy('date desc')->limit(4)->all();
        $data['categories'] = Category::find()->where(['status' => Category::STATUS_ACTIVE])->all();
        return $data;
    }

    /**
     * @param $query ActiveQuery
     * @return string
     */
    protected function renderArticlesList($query)
    {
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->controller->render('archive', [
            'models' => $models,
            'pages' => $pages,
            'dateManager' => $this->controller->dateManager,
            'articleComponent' => $this->controller->articleComponent,
            'sidebarData' => $this->getSidebarData(),
        ]);
    }
}