<?php

use app\modules\admin\assets\FormAdvancedAsset;
use app\modules\blog\models\Article;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */
/* @var $today app\modules\blog\controllers\BaseController */
/* @var $categories Article[] */

$this->title = Yii::t('app', 'Create Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
FormAdvancedAsset::register($this);
?>

<div class="row article-create">
    <div class="col-12">
        <div class="card-box">
            <?= $this->render('_form', [
                'model' => $model,
                'today' => $today,
                'categories' => $categories,
                'tags' => $model->tagsList,
            ]) ?>
        </div>
    </div>
</div>
