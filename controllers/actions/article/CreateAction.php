<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\Article;
use app\modules\blog\Module;
use Yii;
use yii\web\UnauthorizedHttpException;
use yii\web\UploadedFile;

class CreateAction extends BaseAction
{
    public function beforeRun()
    {
        if(!$this->controller->rbacManager->canCreateArticle()){
            throw new UnauthorizedHttpException(Module::t('blog', 'Unauthorized Access'));
        }
        return parent::beforeRun();
    }

    public function run()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {
                $model->image = $model->upload();
            }

            if ($model->save()) {
                $model->saveTags();
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        };

        return $this->controller->render('create', [
            'model' => $model,
            'today' => $this->controller->getIntlToday(),
            'categories' => $this->articleComponent->getCategoriesList(),
        ]);
    }
}