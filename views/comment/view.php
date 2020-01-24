<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Comment */

$this->title = Module::t('blog', 'Comment from {data}. User: {user}', [
    'data' => $model->created_at,
    'user' => $model->user->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
MagnificPopupAsset::register($this);
SweetalertAsset::register($this);
?>
<div class="comment-view card-box">

    <p>
        <?= Html::a(Module::t('blog', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm waves-effect width-md waves-light']) ?>
        <?php if ($model->status == $model::STATUS_ACTIVE): ?>
            <?= Html::a(Module::t('blog', 'Hide'), ['soft-delete', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm waves-effect width-md waves-light']) ?>
        <?php elseif ($model->status == $model::STATUS_DELETED): ?>
            <?= Html::a(Module::t('blog', 'Restore'), ['restore', 'id' => $model->id], ['class' => 'btn btn-success btn-sm waves-effect width-md waves-light']) ?>
        <?php endif; ?>
        <?php if ($rbacManager->haveAdminPermissions()): ?>
            <?= Html::a(Module::t('blog', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm waves-effect width-md waves-light',
                'id' => 'article-delete',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                    'id' => $model->id,
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:ntext',
            [
                'attribute' => 'user_id',
                'label' => Module::t('blog', 'User'),
                'value' => function($data){
                    return $data->user->name;
                },
            ],
            'parent_id',
            [
                'attribute' => 'article_id',
                'label' => Module::t('blog', 'Article'),
                'value' => function($data){
                    return $data->article->title;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function($data){
                    return $data->status === 0 ? Module::t('blog', 'Hidden') : Module::t('blog', 'Active');
                },
            ],
            'created_at:dateTime',
            'updated_at:dateTime',
        ],
    ]) ?>

</div>
