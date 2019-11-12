<?php


namespace app\modules\blog\controllers;


use app\modules\blog\controllers\actions\blog\ArchiveAction;
use app\modules\blog\controllers\actions\blog\ErrorAction;
use app\modules\blog\controllers\actions\blog\IndexAction;
use app\modules\blog\controllers\actions\blog\SingleAction;

class BlogController extends BaseController
{
    public $layout = '@app/modules/blog/views/layout/blog';

    public function actions()
    {
        return [
            'error' => ['class' => ErrorAction::class],
            'index' => ['class' => IndexAction::class],
            'single' => ['class' => SingleAction::class],
            'archive' => ['class' => ArchiveAction::class],
        ];
    }
}