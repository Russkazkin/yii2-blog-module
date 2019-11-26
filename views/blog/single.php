<?php

/* @var $this yii\web\View */
/* @var $model \app\modules\blog\models\Article */
/** @var \app\modules\blog\models\Tag $tags */

$this->title = Yii::t('blog', 'Single');

use yii\helpers\Url; ?>

    <div class="col-md-8">
        <article class="post">
            <div class="post-thumb">
                <a href="<?= Url::toRoute(['blog/single', 'id' => $model->id]) ?>"><img src="<?= $model->getImage(); ?>" alt=""></a>
            </div>
            <div class="post-content">
                <header class="entry-header text-center text-uppercase">
                    <h6>
                        <a href="<?= Url::toRoute(['blog/archive', 'category_id' => $model->category_id]) ?>">
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
                    <a href="<?= Url::toRoute(['blog/archive', 'tag_id' => $tag->id]) ?>" class="btn btn-default">
                        <?= $tag->title; ?>
                    </a>
                    <?php endforeach; ?>
                </div>

                <div class="social-share">
                    <span class="social-share-title float-left text-capitalize">By Rubel <?= $dateManager->timestampToDate($model->date); ?></span>
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
        <div class="row"><!--blog next previous-->
            <div class="col-md-6">
                <div class="single-blog-box">
                    <a href="#">
                        <img src="/temp/blog-next.jpg" alt="">

                        <div class="overlay">

                            <div class="promo-text">
                                <h5><i class="fa fa-2x fa-angle-left"></i>Rubel is doing Cherry theme</h5>
                            </div>
                        </div>


                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="single-blog-box">
                    <a href="#">
                        <img src="/temp/blog-next.jpg" alt="">

                        <div class="overlay">
                            <div class="promo-text">
                                <h5>Rubel is doing Cherry theme<i class="fa fa-2x fa-angle-right"></i></h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div><!--blog next previous end-->
        <div class="related-post-carousel"><!--related post carousel-->
            <div class="related-heading">
                <h4>You might also like</h4>
            </div>
            <div class="items">
                <div class="single-item">
                    <a href="#">
                        <img src="/temp/related-post-1.jpg" alt="">

                        <p>Just Wondering at Beach</p>
                    </a>
                </div>


                <div class="single-item">
                    <a href="#">
                        <img src="/temp/related-post-2.jpg" alt="">

                        <p>Just Wondering at Beach</p>
                    </a>
                </div>


                <div class="single-item">
                    <a href="#">
                        <img src="/temp/related-post-3.jpg" alt="">

                        <p>Just Wondering at Beach</p>
                    </a>
                </div>


                <div class="single-item">
                    <a href="#">
                        <img src="/temp/related-post-1.jpg" alt="">

                        <p>Just Wondering at Beach</p>
                    </a>
                </div>

                <div class="single-item">
                    <a href="#">
                        <img src="/temp/related-post-2.jpg" alt="">

                        <p>Just Wondering at Beach</p>
                    </a>
                </div>


                <div class="single-item">
                    <a href="#">
                        <img src="/temp/related-post-3.jpg" alt="">

                        <p>Just Wondering at Beach</p>
                    </a>
                </div>
            </div>
        </div><!--related post carousel-->
        <div class="bottom-comment"><!--bottom comment-->
            <h4>3 comments</h4>

            <div class="comment-img">
                <img class="rounded-circle" src="/temp/comment-img.jpg" alt="">
            </div>

            <div class="comment-text">
                <a href="#" class="replay btn float-right"> Replay</a>
                <h5>Rubel Miah</h5>

                <p class="comment-date">
                    December, 02, 2015 at 5:57 PM
                </p>


                <p class="para">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy
                    eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                    voluptua. At vero eos et cusam et justo duo dolores et ea rebum.</p>
            </div>
        </div>
        <!-- end bottom comment-->


        <div class="leave-comment"><!--leave comment-->
            <h4>Leave a reply</h4>


            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Website url">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="6" name="message" placeholder="Write Massage"></textarea>
                </div>
                <a href="#" class="btn send-btn">Post Comment</a>
            </form>
        </div><!--end leave comment-->
    </div>
<?= $this->render('_sidebar', [
    'popular' => $sidebarData['popular'],
    'recent' => $sidebarData['recent'],
    'categories' => $sidebarData['categories'],
    'dateManager' => $dateManager,
]);
