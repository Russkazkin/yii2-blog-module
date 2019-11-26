<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\models\Article;
use app\modules\blog\models\Tag;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ArchiveAction extends BaseBlogAction
{
    public function run($category_id = null, $tag_id = null)
    {
        if(isset($category_id)) {
            $query = Article::find()
                ->andWhere(['category_id' => $category_id])
                ->andWhere(['status' => 10])
                ->orderBy(['date' => SORT_DESC]);
            //TODO Add not found exception
        } elseif (isset($tag_id)) {
            $tag = Tag::find()->where(['id' => $tag_id])->one();
            if(!$tag) {
                throw new NotFoundHttpException(Yii::t('blog', 'The requested articles not found.'));
            }
            $query = $tag->getArticles();
        }
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