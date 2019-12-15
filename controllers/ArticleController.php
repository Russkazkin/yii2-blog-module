<?php

namespace app\modules\blog\controllers;

use app\modules\blog\controllers\actions\article\GridAction;
use app\modules\lang\components\LangDateComponent;
use Yii;
use app\modules\blog\models\Article;
use app\modules\blog\models\search\ArticleSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [

            ]);
    }

    public function actions()
    {
        return [
            'grid' => ['class' => GridAction::class],
            ];
    }

    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $articles = Article::findAll(['status' => Article::STATUS_ACTIVE]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'articles' => $articles,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {
                $model->image = $model->upload();
            }

            if ($model->save()) {
                $model->saveTags();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        };

        return $this->render('create', [
            'model' => $model,
            'today' => $this->getIntlToday(),
            'categories' => $model->categoriesList,

        ]);
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
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
