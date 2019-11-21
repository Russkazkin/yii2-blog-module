<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use app\modules\auth\Module;
use yii\helpers\Html;
use yii\web\View;

$this->title = $name;
?>
<div class="col-sm-12 st-content">
    <div id="primary" class="content-area padding-content white-color">
        <main id="main" class="site-main" role="main">

            <section class="error-404 not-found text-center">
                <h1 class="404"><?= Html::encode($this->title) ?></h1>

                <p class="error-message"><?= nl2br(Html::encode($message)) ?></p>

                <div class="row">
                    <div class="col-sm-4 offset-sm-4">
                        <form role="search" method="get" id="searchform" action="#">
                            <div>
                                <input type="text" placeholder="<?= Module::t('blog', 'Search and hit enter...')?>" name="s" id="s"/>
                            </div>
                        </form>
                        <p class="go-back-home"><a href="/"><?= Module::t('blog', 'Back to Home Page')?></a></p>
                    </div>
                </div>
            </section><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
</div>

