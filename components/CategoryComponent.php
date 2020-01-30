<?php


namespace app\modules\blog\components;


use app\modules\blog\models\Article;
use app\modules\blog\models\Category;
use yii\base\BaseObject;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class CategoryComponent extends BaseObject
{
    public function getCategoryNavItems()
    {
        $articles = Article::find()->with(['category' => function($query){
            /* @var $query ActiveQuery */
            $query->andWhere(['status' => Category::STATUS_ACTIVE]);
        }])->groupBy('category_id')->all();
        $categories = Category::find()
            ->where(['id' => ArrayHelper::getColumn($articles, 'category_id')])
            ->with('articles')
            ->all();
        $arr = ArrayHelper::map($categories, 'id', 'title');
        $items = [];
        foreach ($arr as $id => $title) {
            $items[] = [
                'label' => $title,
                'url' => '/blog/archive?id=' . $id,
                'class' => 'nav-link',
            ];
        }
        return $items;
    }
}