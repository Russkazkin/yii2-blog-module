<?php
/* @var $popular \app\modules\blog\models\Article [] */

use app\modules\blog\Module;
use yii\helpers\Url;

/* @var $recent \app\modules\blog\models\Article [] */
/* @var $dateManager \app\modules\lang\components\LangDateComponent */
/* @var $categories \app\modules\blog\models\Category [] */
/* @var $articleComponent \app\modules\blog\components\ArticleComponent */
?>

<div class="col-md-4 sticky_column">
    <div class="primary-sidebar">

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center"><?= Module::t('blog', 'Popular Posts'); ?></h3>
            <?php foreach ($popular as $model): ?>
                <div class="popular-post">
                    <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>" class="popular-img"><img src="<?= $articleComponent->getImage($model) ?>" alt="">

                        <div class="p-overlay"></div>
                    </a>

                    <div class="p-content">
                        <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>" class="text-uppercase"><?= $model->title; ?></a>
                        <span class="p-date"><?= $dateManager->timestampToDate($model->date); ?></span>

                    </div>
                </div>
            <?php endforeach; ?>
        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center"><?= Module::t('blog', 'Recent Posts'); ?></h3>

            <?php foreach ($recent as $model): ?>
            <div class="thumb-latest-posts">
                <div class="media">
                    <div class="media-left mr-3">
                        <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>" class="popular-img"><img src="<?= $articleComponent->getImage($model) ?>" alt="">
                            <div class="p-overlay"></div>
                        </a>
                    </div>
                    <div class="p-content">
                        <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>" class="text-uppercase"><?= $model->title; ?></a>
                        <span class="p-date"><?= $dateManager->timestampToDate($model->date); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center"><?= Module::t('blog', 'Categories'); ?></h3>
            <ul>
                <?php foreach ($categories as $category):?>
                <li>
                    <a href="<?= Url::toRoute(['blog/archive', 'id' => $category->id]) ?>"><?= $category->title; ?></a>
                    <span class="post-count float-right"> (<?= $category->getArticles()->count(); ?>)</span>
                </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</div>