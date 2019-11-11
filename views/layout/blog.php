<?php

use app\assets\AppAsset;
use app\modules\blog\assets\BlogAsset;
use xtetis\bootstrap4glyphicons\assets\GlyphiconAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
GlyphiconAsset::register($this);
BlogAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $this->registerCsrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body>
<nav class="navbar navbar-expand-md main-menu navbar-light">
    <div class="container">
            <a class="navbar-brand" href="/">BLOG</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbar-main">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse justify-content-between" id="navbar-main">

                <ul class="nav navbar-nav text-uppercase">
                    <li><a data-toggle="dropdown" class="dropdown-toggle" href="index.html">Home</a>

                    </li>
                </ul>
                <div class="auth">
                    <ul class="nav navbar-nav text-uppercase ">
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                    </ul>
                </div>

            </div>
    </div>
</nav>


<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <?= $content; ?>

        </div>
    </div>
</div>
<!-- end main content-->
<!--footer start-->


<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <aside class="footer-widget">
                    <div class="about-img"><img src="/temp/logo2.png" alt=""></div>
                    <div class="about-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                        nonumy
                        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed voluptua. At vero eos et
                        accusam et justo duo dlores et ea rebum magna text ar koto din.
                    </div>
                    <div class="address">
                        <h4 class="text-uppercase">contact Info</h4>

                        <p> 14529/12 NK Streets, DC, KZ</p>

                        <p> Phone: +123 456 78900</p>

                        <p>mytreasure.com</p>
                    </div>
                </aside>
            </div>

            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Testimonials</h3>

                    <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                        <!--Indicator-->
                        <ol class="carousel-indicators">
                            <li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#testimonialCarousel" data-slide-to="1"></li>
                            <li data-target="#testimonialCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                                            tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                                            vero eos et accusam justo duo dolores et ea rebum.gubergren no sea
                                            takimata
                                            magna aliquyam eratma</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/temp/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Sophia</h4>

                                            <h4>CEO, ReadyTheme</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                                            tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                                            vero eos et accusam justo duo dolores et ea rebum.gubergren no sea
                                            takimata
                                            magna aliquyam eratma</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/temp/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Sophia</h4>

                                            <h4>CEO, ReadyTheme</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                                            tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                                            vero eos et accusam justo duo dolores et ea rebum.gubergren no sea
                                            takimata
                                            magna aliquyam eratma</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/temp/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Sophia</h4>

                                            <h4>CEO, ReadyTheme</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Custom Category Post</h3>


                    <div class="custom-post">
                        <div>
                            <a href="#"><img src="/temp/footer-img.png" alt=""></a>
                        </div>
                        <div>
                            <a href="#" class="text-uppercase">Home is peaceful Place</a>
                            <span class="p-date">February 15, 2016</span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">&copy; 2015 <a href="#">Treasure PRO, </a> Built with <i
                                class="fa fa-heart"></i> by <a href="#">Rahim</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>