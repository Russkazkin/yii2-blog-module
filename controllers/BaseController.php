<?php


namespace app\modules\blog\controllers;


use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    protected function getIntlToday()
    {
        return Yii::$app->formatter->asDate(date('Y-m-d'), 'medium');
    }
}