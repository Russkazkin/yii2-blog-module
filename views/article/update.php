<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */
/* @var $imagePreview*/

$this->title = Yii::t('app', 'Update Article: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update-form', [
        'model' => $model,
        'today' => date($model->phpFormat, $model->date),
        'imagePreview' => $imagePreview,
        'categories' => $model->categoriesList,
        'tags' => $model->tagsList,
        'selectedTags' => $model->selectedTags,
    ]) ?>

</div>
