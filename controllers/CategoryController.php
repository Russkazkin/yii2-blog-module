<?php

namespace app\modules\blog\controllers;

use app\modules\blog\controllers\actions\category\CreateAction;
use app\modules\blog\controllers\actions\category\DeleteAction;
use app\modules\blog\controllers\actions\category\IndexAction;
use app\modules\blog\controllers\actions\category\RestoreAction;
use app\modules\blog\controllers\actions\category\SoftDeleteAction;
use app\modules\blog\controllers\actions\category\UpdateAction;
use app\modules\blog\controllers\actions\category\ViewAction;
use Yii;
use app\modules\blog\models\Category;
use app\modules\blog\models\search\CategorySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'index' => ['class' => IndexAction::class],
            'view' => ['class' => ViewAction::class],
            'soft-delete' => ['class' => SoftDeleteAction::class],
            'restore' => ['class' => RestoreAction::class],
            'create' => ['class' => CreateAction::class],
            'update' => ['class' => UpdateAction::class],
            'delete' => ['class' => DeleteAction::class],
        ];
    }

    public function beforeAction($action)
    {
        if ($action = 'delete') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('blog', 'The requested page does not exist.'));
    }
}
