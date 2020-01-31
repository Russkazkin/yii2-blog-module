<?php


namespace app\modules\blog\controllers\actions\blog;


use app\modules\blog\models\Article;
use app\modules\blog\models\Category;
use app\modules\blog\Module;
use Yii;
use yii\web\NotFoundHttpException;

class ArchiveAction extends BaseBlogAction
{
    public function run($id)
    {
        $query = Article::find()
            ->andWhere(['category_id' => $id])
            ->andWhere(['status' => 10])
            ->orderBy(['date' => SORT_DESC]);
        $name = Category::find()
            ->where(['id' => $id])
            ->one()
            ->title;
        $title = Module::t('blog', 'Category {name}', ['name' => $name]);

        if(!$query->all()){
            throw new NotFoundHttpException(Yii::t('blog', 'There are no posts in this category yet.'));
        }
        return self::renderArticlesList($query, $title);
    }
}