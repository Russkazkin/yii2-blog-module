<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\auth\models\User;
use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use app\modules\blog\models\Category;
use yii\data\Pagination;
use yii\db\ActiveQuery;

class BaseBlogAction extends BaseAction
{
    private function getCategoriesList()
    {
        return Category::find()->all();
    }

    private function getPopularArticles()
    {
        return Article::find()->orderBy('viewed desc')->limit(3)->all();
    }

    private function getRecentArticles()
    {
        return Article::find()->orderBy('date desc')->limit(4)->all();
    }

    protected function getSidebarData()
    {
        $data = [];
        $data['popular'] = self::getPopularArticles();
        $data['recent'] = self::getRecentArticles();
        $data['categories'] = self::getCategoriesList();
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
            'sidebarData' => $this->getSidebarData(),
        ]);
    }
}