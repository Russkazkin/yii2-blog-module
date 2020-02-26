<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\QuillStylesAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Comment */

$this->title = StringHelper::truncate($model->content, 20);
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
MagnificPopupAsset::register($this);
QuillStylesAsset::register($this);
SweetalertAsset::register($this);
?>
<div class="card-box">

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
            //'id',
            //'entity',
            //'entityId',
            'content:ntext',
            //'parentId',
            'level',
            [
                'attribute' => 'createdBy',
                'label' => Module::t('blog', 'Created By'),
                'value' => function($data){
                    return $data->creator->name;
                }
            ],
            'updatedBy',
            'relatedTo',
            'url:ntext',
            'status',
            'createdAt:date',
            'updatedAt:date',
        ],
    ]) //TODO Разбобраться с url ?>

</div>
