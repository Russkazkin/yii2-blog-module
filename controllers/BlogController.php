<?php


namespace app\modules\blog\controllers;


use app\modules\blog\controllers\actions\blog\IndexAction;

class BlogController extends BaseController
{
    public $layout = '@app/modules/blog/views/layout/blog';

    public function actions()
    {
        return [
            'index' => ['class' => IndexAction::class],
        ];
    }
}