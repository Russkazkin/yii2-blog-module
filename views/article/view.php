<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
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
