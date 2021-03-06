<?php

namespace app\modules\blog\controllers;

use app\modules\blog\controllers\actions\tag\CreateAction;
use app\modules\blog\controllers\actions\tag\DeleteAction;
use app\modules\blog\controllers\actions\tag\IndexAction;
use app\modules\blog\controllers\actions\tag\RestoreAction;
use app\modules\blog\controllers\actions\tag\SoftDeleteAction;
use app\modules\blog\controllers\actions\tag\ViewAction;
use app\modules\blog\models\search\TagSearch;
use app\modules\blog\models\Tag;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
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
            'delete' => ['class' => DeleteAction::class],
            'create' => ['class' => CreateAction::class],
        ];
    }
    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('blog', 'The requested page does not exist.'));
    }
}
