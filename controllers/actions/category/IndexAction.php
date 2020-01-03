<?php


namespace app\modules\blog\controllers\actions\category;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Category;

class IndexAction extends BaseAction
{
    public function run()
    {
        $categories = Category::find()->all();

        return $this->controller->render('index', [
            'categories' => $categories,
            'rbacManager' => $this->controller->rbacManager,
        ]);
    }
}