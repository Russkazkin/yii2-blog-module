<?php
use app\modules\admin\assets\FormAdvancedAsset;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Category */

$this->title = Yii::t('blog', 'Update Category: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'Update');
FormAdvancedAsset::register($this); ?>


<div class="category-update row">
    <div class="col-12">
        <div class="card-box">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
