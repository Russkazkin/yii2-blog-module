<?php

use app\modules\admin\assets\DataTablesAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
?>
<div class="card-box">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm waves-effect width-md waves-light']) ?>
        <?php if ($model->status == $model::STATUS_ACTIVE): ?>
        <?= Html::a(Yii::t('app', 'Hide'), ['soft-delete', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm waves-effect width-md waves-light']) ?>
        <?php elseif ($model->status == $model::STATUS_DELETED): ?>
        <?= Html::a(Yii::t('app', 'Restore'), ['restore', 'id' => $model->id], ['class' => 'btn btn-success btn-sm waves-effect width-md waves-light']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm waves-effect width-md waves-light',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'content:ntext',
            'date:date',
            [
                'label' => Yii::t('app', 'Category'),
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->title;
                }
            ],
            [
                'label' => Yii::t('app', 'Tags'),
                'value' => function($data) {
                    return $data->selectedTagsTitle;
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'label' => Yii::t('app', 'Image'),
                'value' => function($data){
                    return Html::img($data->getImage(), ['height' => '50']);
                },
            ],
            'viewed',
            'user_id',
            'status',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>
</div>
