<?php

use app\modules\admin\assets\FormAdvancedAsset;
use app\modules\blog\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */
/* @var $imagePreview*/

$this->title = Module::t('blog', 'Update Article: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
FormAdvancedAsset::register($this);
?>
<div class="row article-update">
    <div class="col-12">
        <div class="card-box">
            <?= $this->render('_update-form', [
                'model' => $model,
                'today' => date($model->phpFormat, $model->date),
                'imagePreview' => $imagePreview,
                'categories' => $model->categoriesList,
                'tags' => $model->tagsList,
                'selectedTags' => $model->selectedTags,
            ]) ?>
        </div>
    </div>
</div>
