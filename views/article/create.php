<?php

use app\modules\blog\models\Article;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */
/* @var $today app\modules\blog\controllers\BaseController */
/* @var $categories Article[] */

$this->title = Yii::t('app', 'Create Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('_form', [
        'model' => $model,
        'today' => $today,
        'categories' => $categories,
        'tags' => $model->tagsList,
    ]) ?>

</div>
