<?php


namespace app\modules\blog\controllers\actions\article;


use app\modules\blog\controllers\actions\BaseAction;
use app\modules\blog\models\search\ArticleSearch;
use Yii;
use yii\web\UnauthorizedHttpException;

class GridAction extends BaseAction
{
    public function run()
    {
        if(!Yii::$app->user->can('adminArticlesPermissions')){
            throw new UnauthorizedHttpException('Unauthorized Access');
        }
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->controller->render('grid', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}