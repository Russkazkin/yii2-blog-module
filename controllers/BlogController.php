<?php


namespace app\modules\blog\controllers;


use app\modules\blog\controllers\actions\blog\IndexAction;

class BlogController extends BaseController
{
    public function actions()
    {
        return [
            'index' => ['class' => IndexAction::class],
        ];
    }
}