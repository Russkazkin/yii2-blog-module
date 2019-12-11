<?php


namespace app\modules\blog\controllers;


use app\modules\lang\components\LangDateComponent;
use Yii;
use yii\web\Controller;


/**
 * Class BaseController
 * @package app\modules\blog\controllers
 * @property LangDateComponent dateManager
 */
class BaseController extends Controller
{

    public $dateManager;

    public function __construct($id, $module, $config = [])
    {
        $this->dateManager = Yii::$app->getModule('lang')->dateManager;

        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    protected function getIntlToday()
    {
        return Yii::$app->formatter->asDate(date('Y-m-d'));
    }
}