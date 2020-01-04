<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Categories'), 'url' => ['index']];
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
        <?php if ($rbacManager->haveAdminPermissions()): ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm waves-effect width-md waves-light',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return $data->status === 0 ? Module::t('blog', 'Hidden') : Module::t('blog', 'Active');
                },
            ],
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
