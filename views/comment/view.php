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
        <?= Html::a(Yii::t('blog', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('blog', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('blog', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:ntext',
            'user_id',
            'parent_id',
            'article_id',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
