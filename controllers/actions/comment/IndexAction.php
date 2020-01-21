<?php

namespace app\modules\blog\controllers\actions\comment;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Comment;

class IndexAction extends BaseAction
{
    public function run()
    {
        $comments = Comment::find()->with(['article', 'user'])->all();
        return $this->controller->render('index',
            [
                'comments' => $comments,
                'rbacManager' => $this->controller->rbacManager,
            ]);
    }
}