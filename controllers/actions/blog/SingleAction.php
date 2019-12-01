<?php


namespace app\modules\blog\controllers\actions\blog;

use app\modules\blog\controllers\BlogController;

/** @var $model \app\modules\blog\models\Article
 * @var $controller BlogController
*/


class SingleAction extends BaseBlogAction
{
    public function run($id)
    {
        $model = $this->controller->findModel($id);
        return $this->controller->render('single', [
            'model' => $model,
            'tags' => $model->getTags()->all(),
            'sidebarData' => $this->getSidebarData(),
            'dateManager' => $this->controller->dateManager,
        ]);
    }
}