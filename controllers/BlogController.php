<?php


namespace app\modules\blog\controllers;


use app\modules\blog\controllers\actions\blog\ArchiveAction;
use app\modules\blog\controllers\actions\blog\ErrorAction;
use app\modules\blog\controllers\actions\blog\IndexAction;
use app\modules\blog\controllers\actions\blog\SingleAction;
use app\modules\blog\models\Article;
use Yii;
use yii\web\NotFoundHttpException;

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

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}