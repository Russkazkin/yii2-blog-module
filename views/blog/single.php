<?php

/** @var $this yii\web\View
 * @var $model \app\modules\blog\models\Article
 * @var \app\modules\blog\models\Tag $tags
 * @var \app\modules\lang\components\LangDateComponent $dateManager
 * @var $sidebarData \app\modules\blog\controllers\actions\blog\BaseBlogAction::getSidebarData()
 * @var $pages \yii\data\Pagination
 * @var $authorItems \app\modules\blog\models\Article []
 * @var $related \app\modules\blog\models\Article []
 * @var $comments \app\modules\blog\models\Comment []
 * @var $commentsCount
 * @var $message \app\modules\blog\models\Comment
 */


$this->title = $model->title;

use app\modules\blog\Module;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\Pjax; ?>

    <div class="col-md-8">
        <article class="post">
            <div class="post-thumb">
                <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>"><img src="<?= $articleComponent->getImage($model) ?>" alt=""></a>
            </div>
            <div class="post-content">
                <header class="entry-header text-center text-uppercase">
                    <h6>
                        <a href="<?= Url::toRoute(['blog/archive', 'id' => $model->category_id]) ?>">
                            <?= $model->category->title; ?>
                        </a>
                    </h6>

                    <h1 class="entry-title"><a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>"><?= $model->title; ?></a></h1>


                </header>
                <div class="entry-content">
                    <?= $model->content; ?>
                </div>
                <div class="decoration">
                    <?php
                    foreach ($tags as $tag): ?>
                    <a href="<?= Url::toRoute(['blog/tag', 'id' => $tag->id]) ?>" class="btn btn-default">
                        <?= $tag->title; ?>
                    </a>
                    <?php endforeach; ?>
                </div>

                <div class="social-share">
                    <span class="social-share-title float-left text-capitalize">
                        <a href="<?= Url::toRoute(['blog/author', 'id' => $model->user_id]) ?>">
                            <?= Module::t('blog', 'By {author} On ', ['author' => $model->user->name])?>
                        </a>
                        <?= $dateManager->timestampToDate($model->date); ?>
                    </span>
                    <ul class="text-center float-right">
                        <li><a class="s-facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="s-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a class="s-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a class="s-linkedin" href="#"><i class="fab fa-linkedin-in"></i></i></a></li>
                        <li><a class="s-instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </article>
        <div class="top-comment"><!--top comment-->
            <img src="/temp/comment.jpg" class="float-left rounded-circle" alt="">
            <h4>Rubel Miah</h4>

            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                invidunt ut labore et dolore magna aliquyam erat.</p>
        </div><!--top comment end-->
        <?php Pjax::begin(['timeout' => 2000, 'id' => 'author-carousel', 'enablePushState' => false]); ?>
        <div class="row author-carousel" id="author-carousel"><!--blog next previous-->
            <div class="author-carousel-loader">
            <!--LOADER-->
                <div class="lds-roller">
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                </div>
            </div>
            <!--/LOADER-->
            <div class="col-md-6 author-carousel-item">
                <div class="single-blog-arrow">
                    <?= Html::a('<i class="fa fa-2x fa-angle-left"></i>', $pages->links['prev'], ['class' => 'rounded-circle']);?>
                </div>
                <div class="single-blog-box" style="background-image: url('<?= $articleComponent->getImage($authorItems[0]) ?>')">
                    <a href="<?= Url::toRoute(['blog/single', 'id' => $authorItems[0]->id]) ?>"
                       data-pjax="0">
                        <div class="overlay">
                            <div class="promo-text">
                                <h5>
                                    <?= $authorItems[0]->title; ?>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <?php if(isset($authorItems[1])):?>
            <div class="col-md-6 author-carousel-item">
                <div class="single-blog-box" style="background-image: url('<?= $articleComponent->getImage($authorItems[1]) ?>')">
                    <a href="<?= Url::toRoute(['blog/single', 'id' => $authorItems[1]->id], ['data-pjax' => 0]) ?>"
                       data-pjax="0">
                        <div class="overlay">
                            <div class="promo-text">
                                <h5>
                                    <?= $authorItems[1]->title; ?>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="single-blog-arrow">
                    <?= Html::a('<i class="fa fa-2x fa-angle-right"></i>', $pages->links['next'], ['class' => 'rounded-circle']);?>
                </div>
            </div>
            <?php endif; ?>
        </div><!--blog next previous end-->
        <?php Pjax::end(); ?>
        <div class="related-post-carousel"><!--related post carousel-->
            <div class="related-heading">
                <h4>You might also like</h4>
            </div>
            <div class="items">
                <?php foreach ($related as $item):?>
                <div class="single-item">

                    <a href="<?= Url::toRoute(['blog/single', 'id' => $item->id]) ?>">
                        <div class="single-item-img" style="background-image: url('<?= $articleComponent->getImage($item) ?>')"></div>
                        <p><?= $item->title; ?></p>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div><!--related post carousel-->

        <?php echo \yii2mod\comments\widgets\Comment::widget([
            'model' => $model,
            'relatedTo' => 'User ' . Yii::$app->user->identity->name . ' commented on the page ' . \yii\helpers\Url::current(),
            'maxLevel' => 2,
            'dataProviderConfig' => [
                'pagination' => [
                    'pageSize' => 10
                ],
            ],
            'listViewConfig' => [
                'emptyText' => Yii::t('app', 'No comments found.'),
            ],
        ]); ?>

    </div>
<?= $this->render('_sidebar', [
    'popular' => $sidebarData['popular'],
    'recent' => $sidebarData['recent'],
    'categories' => $sidebarData['categories'],
    'dateManager' => $dateManager,
    'articleComponent' => $articleComponent,
]);
