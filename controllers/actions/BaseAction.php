<?php


namespace app\modules\blog\controllers\actions;


use app\modules\blog\components\ArticleComponent;
use yii\base\Action;

/**
 * Class BaseAction
 * @package app\modules\blog\controllers\actions
 * @property ArticleComponent $articleComponent
 */
class BaseAction extends Action
{
    protected $articleComponent;

    public function init()
    {
        parent::init();
        $this->articleComponent = $this->controller->articleComponent;
    }
}