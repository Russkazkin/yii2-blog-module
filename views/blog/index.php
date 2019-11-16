<?php

/* @var $this yii\web\View */
/* @var $pages \yii\data\Pagination */
/* @var $models \app\modules\blog\models\Article [] */

$this->title = Yii::t('blog', 'Blog');

use yii\bootstrap4\LinkPager; ?>

<div class="col-md-8">
    <?php foreach ($models as $model): ?>
        <article class="post">
            <div class="post-thumb">
                <a href="blog.html"><img src="/temp/blog-1.jpg" alt=""></a>

                <a href="blog.html" class="post-thumb-overlay text-center">
                    <div class="text-uppercase text-center">View Post</div>
                </a>
            </div>
            <div class="post-content">
                <header class="entry-header text-center text-uppercase">
                    <h6><a href="#"> Travel</a></h6>

                    <h1 class="entry-title"><a href="blog.html">Home is peaceful place</a></h1>


                </header>
                <div class="entry-content">
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        tevidulabore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                        accusam et
                        justo duo dolores rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                        Lorem
                        ipsum dolor sit am Lorem ipsum dolor sitconsetetur sadipscing elitr, sed diam nonumy
                        eirmod tempor invidunt ut labore et dolore maliquyam erat, sed diam voluptua.
                    </p>

                    <div class="btn-continue-reading text-center text-uppercase">
                        <a href="blog.html" class="more-link">Continue Reading</a>
                    </div>
                </div>
                <div class="social-share">
                            <span class="social-share-title float-left text-capitalize">By <a href="#">Rubel</a> On
                                February 12, 2016</span>
                    <ul class="text-center float-right">
                        <li><a class="s-facebook" href="#"><i class="fas fa-eye"></i></a></li>
                        325
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
