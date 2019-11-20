<?php

/* @var $this yii\web\View */
/* @var $pages \yii\data\Pagination */
/* @var $models \app\modules\blog\models\Article [] */
/* @var $dateManager \app\modules\lang\components\LangDateComponent */

$this->title = Yii::t('blog', 'Blog');

use yii\bootstrap4\LinkPager; ?>

<div class="col-md-8">
    <?php foreach ($models as $model): ?>
        <article class="post">
            <div class="post-thumb">
                <a href="blog.html"><img src="<?= $model->getImage(); ?>" alt="<?= $model->image; ?>"></a>

                <a href="blog.html" class="post-thumb-overlay text-center">
                    <div class="text-uppercase text-center">View Post</div>
                </a>
            </div>
            <div class="post-content">
                <header class="entry-header text-center text-uppercase">
                    <h6><a href="#"><?= $model->category->title; ?></a></h6>

                    <h1 class="entry-title"><a href="blog.html"><?= $model->title; ?></a></h1>


                </header>
                <div class="entry-content">
                    <p><?= $model->description; ?></p>

                    <div class="btn-continue-reading text-center text-uppercase">
                        <a href="blog.html" class="more-link">Continue Reading</a>
                    </div>
                </div>
                <div class="social-share">
                            <span class="social-share-title float-left text-capitalize">By <a href="#">Rubel</a> On
                                <?= $dateManager->timestampToDate($model->date); ?></span>
                    <ul class="text-center float-right">
                        <li><a class="s-facebook" href="#"><i class="fas fa-eye"></i></a></li>
                        <?= (int) $model->viewed; ?>
                    </ul>
                </div>
            </div>
        </article>
    <?php endforeach; ?>

    <?= LinkPager::widget([
            'pagination' => $pages
    ])?>
</div>
<?= $this->render('_sidebar');
