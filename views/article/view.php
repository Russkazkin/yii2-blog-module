<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\QuillStylesAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\DetailView;

/** @var $this yii\web\View
 * @var $model app\modules\blog\models\Article
 * @var $articleComponent \app\modules\blog\components\ArticleComponent
 * @var $rbacManager \app\modules\auth\components\RbacComponent
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = StringHelper::truncate($this->title, 36);
DataTablesAsset::register($this);
MagnificPopupAsset::register($this);
QuillStylesAsset::register($this);
SweetalertAsset::register($this);
$model->image = $articleComponent->getImage($model);
?>
<div class="card-box">
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
            'title',
            'description:ntext',
            'content:html',
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
                    return '<div class="article-image-wrap">' . Html::a(Html::img($data->image, ['height' => '100']), $data->image, ['class' => 'article-image-popup']) . '</div>';
                },
            ],
            'viewed',
            [
                'attribute' => 'user_id',
                'label' => Module::t('blog', 'User'),
                'value' => function($data){
                    return $data->user->name;
                },
            ],
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
