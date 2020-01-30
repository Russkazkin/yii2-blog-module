<?php


namespace app\modules\blog\components;


use app\modules\blog\models\Article;
use app\modules\blog\models\Category;
use yii\base\BaseObject;
use yii\db\ActiveQuery;

class CategoryComponent extends BaseObject
{
    public function getCategoryNavItems()
    {
        $articles = Article::find()->with(['category' => function($query){
            /* @var $query ActiveQuery */
            $query->andWhere(['status' => Category::STATUS_ACTIVE]);
        }])->groupBy('category')->all();
        return $articles;
    }
}