<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\search\ArticleSearch;
use Yii;
use yii\web\UnauthorizedHttpException;

class GridAction extends BaseAction
{

    public function beforeRun()
    {
        if(!$this->controller->rbacManager->haveAdminPermissions()){
            throw new UnauthorizedHttpException('Unauthorized Access');
        }
        return parent::beforeRun();
    }

    public function run()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->controller->render('grid', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}