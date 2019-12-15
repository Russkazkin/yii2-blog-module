<?php


namespace app\modules\blog\controllers;


use app\modules\lang\components\LangDateComponent;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * Class BaseController
 * @package app\modules\blog\controllers
 * @property LangDateComponent dateManager
 */
class BaseController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]);
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