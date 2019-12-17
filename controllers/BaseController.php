<?php


namespace app\modules\blog\controllers;


use app\modules\auth\components\RbacComponent;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * Class BaseController
 * @package app\modules\blog\controllers
 * @property RbacComponent rbacManager
 */
class BaseController extends Controller
{

    public $rbacManager;

    public function __construct($id, $module, $config = [])
    {
        $this->rbacManager = Yii::$app->getModule('auth')->rbac;

        parent::__construct($id, $module, $config);
    }

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