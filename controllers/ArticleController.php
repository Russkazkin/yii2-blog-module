<?php

namespace app\modules\blog\controllers;

use app\modules\blog\components\ArticleComponent;
use app\modules\blog\controllers\actions\article\CreateAction;
use app\modules\blog\controllers\actions\article\GridAction;
use app\modules\blog\controllers\actions\article\IndexAction;
use app\modules\blog\controllers\actions\article\RestoreAction;
use app\modules\blog\controllers\actions\article\SoftDeleteAction;
use app\modules\blog\controllers\actions\article\ViewAction;
use Yii;
use app\modules\blog\models\Article;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 * @property ArticleComponent $articleComponent
 */
class ArticleController extends BaseController
{
    public $articleComponent;

    public function init()
    {
        parent::init();
        $this->articleComponent = Yii::$app->getModule('blog')->article;
    }

    public function actions()
    {
        return [
            'index' => ['class' => IndexAction::class],
            'grid' => ['class' => GridAction::class],
            'soft-delete' => ['class' => SoftDeleteAction::class],
            'restore' => ['class' => RestoreAction::class],
            'view' => ['class' => ViewAction::class],
            'create' => ['class' => CreateAction::class],
            ];
    }
    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagePreview = $model->image ? '/blog_uploads/' . $model->image : null;

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');

            $model->image = $model->file ? $model->upload($model->image) : $model->getOldAttribute('image');

            if ($model->save()) {
                $model->saveTags();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        };

        return $this->render('update', [
            'model' => $model,
            'imagePreview' => $imagePreview,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //TODO: Add image removal before article delete
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRemoveImg()
    {
        $id = Yii::$app->request->post()['key'];
        $model = $this->findModel($id);

        if(!empty($model->image)) {
            if($model->fileExists($model->image)) {
                unlink(Yii::getAlias('@blog_uploads') . $model->image);
            }
            $model->image = null;
            if ($model->save()) {
                return json_encode(
                    [
                        'success' => true,
                    ]
                );
            }
        }
        return json_encode(
            [
                'error' => false,
            ]
        );
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
