<?php


namespace app\modules\blog\controllers;


use app\modules\blog\components\ArticleComponent;
use app\modules\blog\controllers\actions\blog\ArchiveAction;
use app\modules\blog\controllers\actions\blog\AuthorAction;
use app\modules\blog\controllers\actions\blog\ErrorAction;
use app\modules\blog\controllers\actions\blog\IndexAction;
use app\modules\blog\controllers\actions\blog\SingleAction;
use app\modules\blog\controllers\actions\blog\TagAction;
use app\modules\blog\models\Article;
use app\modules\blog\models\Category;
use app\modules\lang\components\LangDateComponent;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class BlogController
 * @package app\modules\blog\controllers
 * @property ArticleComponent $articleComponent
 * @property LangDateComponent $dateManager
 */
class BlogController extends Controller
{
    public $layout = '@app/modules/blog/views/layout/blog';
    public $dateManager;
    public $articleComponent;
    public $categoryNav;

    public function init()
    {
        parent::init();
        $this->dateManager = Yii::$app->getModule('lang')->dateManager;
        $this->articleComponent = Yii::$app->getModule('blog')->article;
        $this->categoryNav = Category::navigation();

    }

    public function actions()
    {
        return [
            'error' => ['class' => ErrorAction::class],
            'index' => ['class' => IndexAction::class],
            'single' => ['class' => SingleAction::class],
            'archive' => ['class' => ArchiveAction::class],
            'tag' => ['class' => TagAction::class],
            'author' => ['class' => AuthorAction::class],
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