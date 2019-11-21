<?php
/* @var $popular \app\modules\blog\controllers\actions\blog\BaseBlogAction[] */
/* @var $recent \app\modules\blog\controllers\actions\blog\BaseBlogAction */
/* @var $model \app\modules\blog\models\Article */
/* @var $dateManager \app\modules\lang\components\LangDateComponent */
?>

<div class="col-md-4 sticky_column">
    <div class="primary-sidebar">

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
            <?php foreach ($popular as $model): ?>
                <div class="popular-post">
                    <a href="#" class="popular-img"><img src="<?= $model->getImage(); ?>" alt="">

                        <div class="p-overlay"></div>
                    </a>

                    <div class="p-content">
                        <a href="#" class="text-uppercase"><?= $model->title; ?></a>
                        <span class="p-date"><?= $dateManager->timestampToDate($model->date); ?></span>

                    </div>
                </div>
            <?php endforeach; ?>
        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>

            <?php foreach ($recent as $model): ?>
            <div class="thumb-latest-posts">
                <div class="media">
                    <div class="media-left mr-3">
                        <a href="#" class="popular-img"><img src="<?= $model->getImage(); ?>" alt="">
                            <div class="p-overlay"></div>
                        </a>
                    </div>
                    <div class="p-content">
                        <a href="#" class="text-uppercase"><?= $model->title; ?></a>
                        <span class="p-date"><?= $dateManager->timestampToDate($model->date); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                <li>
                    <a href="#">Food & Drinks</a>
                    <span class="post-count float-right"> (2)</span>
                </li>
                <li>
                    <a href="#">Travel</a>
                    <span class="post-count float-right"> (2)</span>
                </li>
                <li>
                    <a href="#">Business</a>
                    <span class="post-count float-right"> (2)</span>
                </li>
                <li>
                    <a href="#">Story</a>
                    <span class="post-count float-right"> (2)</span>
                </li>
                <li>
                    <a href="#">DIY & Tips</a>
                    <span class="post-count float-right"> (2)</span>
                </li>
                <li>
                    <a href="#">Lifestyle</a>
                    <span class="post-count float-right"> (2)</span>
                </li>
            </ul>
        </aside>
    </div>
</div>