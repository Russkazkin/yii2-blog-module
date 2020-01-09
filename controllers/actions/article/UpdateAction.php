<?php


namespace app\modules\blog\controllers\actions\article;

use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;
use yii\web\UploadedFile;

class UpdateAction extends BaseAction
{
    public function run($id)
    {
        /* @var Article $model */

        $model = $this->controller->findModel($id);

        if (!$this->controller->rbacManager->canEditArticle($model)){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }

        $imagePreview = $model->image ? '/blog_uploads/' . $model->image : null;

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');

            $model->image = $model->file ? $model->upload($model->image) : $model->getOldAttribute('image');

            if ($model->save()) {
                $model->saveTags();
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        };

        return $this->controller->render('update', [
            'model' => $model,
            'imagePreview' => $imagePreview,
            'categories' => $this->articleComponent->getCategoriesList(),
            'tags' => $this->articleComponent->getTagsList(),
        ]);
    }
}