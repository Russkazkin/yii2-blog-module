<?php

/** @var $this yii\web\View
 * @var $pages \yii\data\Pagination
 * @var $models \app\modules\blog\models\Article []
 * @var $dateManager \app\modules\lang\components\LangDateComponent
 * @var $sidebarData \app\modules\blog\controllers\actions\blog\BaseBlogAction::getSidebarData() []
 * @var $articleComponent \app\modules\blog\components\ArticleComponent
 */

use app\modules\blog\Module;
use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\web\View;

$this->title = $title;

?>

<div class="col-md-8">
<?php foreach ($models as $model): ?>
    <article class="post post-list">
        <div class="row">
            <div class="col-md-6">
                <div class="post-thumb">
                    <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>"><img src="<?= $articleComponent->getImage($model) ?>" alt="" class="pull-left"></a>

                    <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>" class="post-thumb-overlay text-center">
                        <div class="text-uppercase text-center"><?= Module::t('blog', 'View Post'); ?></div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="post-content">
                    <header class="entry-header text-uppercase">
                        <h6><a href="<?= Url::toRoute(['blog/archive', 'id' => $model->category_id]) ?>"><?=
                                $model->category->title; ?></a></h6>

                        <h1 class="entry-title">
                            <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>">
                                <?= $model->title; ?>
                            </a>
                        </h1>
                    </header>
                    <div class="entry-content">
                        <p>
                        <?= $articleComponent->getDescription($model); ?>
                        </p>
                    </div>
                    <div class="social-share">
                        <span class="social-share-title pull-left text-capitalize">
                            <a href="<?= Url::toRoute(['blog/author', 'id' => $model->user_id]) ?>">
                                <?= Module::t('blog', 'By {author} On ', ['author' => $model->user->name])?>
                            </a>
                            <?= $dateManager->timestampToDate($model->date); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php endforeach; ?>
<?= LinkPager::widget([
    'pagination' => $pages
])?>
</div>
<?= $this->render('_sidebar', [
    'popular' => $sidebarData['popular'],
    'recent' => $sidebarData['recent'],
    'categories' => $sidebarData['categories'],
    'dateManager' => $dateManager,
    'articleComponent' => $articleComponent,
]);