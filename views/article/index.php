<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\widgets\notification\NotificationWidget;
use app\modules\blog\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $articles \app\modules\blog\models\Article [] */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
?>

<div class="row">
    <div class="col-12">
        <p>
            <?= Html::a(Module::t('blog', 'Create Article'), ['create'], ['class' => 'btn btn-success btn-sm waves-effect width-md waves-light']) ?>
        </p>
        <?php if( Yii::$app->session->hasFlash('success') ): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php endif;?>
        <?= NotificationWidget::widget(); ?>
        <div class="card-box">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                <tr>
                    <th><?=Module::t('blog', 'Title')?></th>
                    <th><?=Module::t('blog', 'Category')?></th>
                    <th><?=Module::t('blog', 'Date')?></th>
                    <th><?=Module::t('blog', 'Tags')?></th>
                    <th><?=Module::t('blog', 'Image')?></th>
                    <th><?=Module::t('blog', 'Actions')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($articles as $article):?>
                <tr>
                    <td><?= $article->title; ?></td>
                    <td><?= $article->category->title; ?></td>
                    <td><?= $article->timestampToDate(); ?></td>
                    <td><?= $article->getSelectedTagsTitle(); ?></td>
                    <td><img src="<?= $article->getImage(); ?>" alt="<?= $article->title; ?> img" height="20"></td>
                    <td>
                        <?= Html::a('<i class="mdi mdi-note-text"></i>',
                            ['view', 'id' => $article->id],
                            ['title' => 'View']) ?>
                        <?= Html::a('<i class="mdi mdi-pencil-outline"></i>',
                            ['update', 'id' => $article->id],
                            ['title' => 'Update']) ?>
                        <?php if($article->status == $article::STATUS_ACTIVE):?>
                            <?= Html::a('<i class="mdi mdi-eye-off"></i>',
                                ['soft-delete', 'id' => $article->id],
                                ['title' => 'Hide']) ?>
                        <?php elseif ($article->status == $article::STATUS_DELETED): ?>
                            <?= Html::a('<i class="mdi mdi-eye"></i>',
                                ['restore', 'id' => $article->id],
                                ['title' => 'Restore']) ?>
                        <?php endif; ?>
                        <?= Html::a('<i class="mdi mdi-delete"></i>',
                            ['delete', 'id' => $article->id],
                            ['data-method' => 'post', 'title' => 'Delete']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>