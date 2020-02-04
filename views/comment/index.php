<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\search\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Comments');
$this->params['breadcrumbs'][] = $this->title;

DataTablesAsset::register($this);
SweetalertAsset::register($this);
MagnificPopupAsset::register($this);
?>
<div class="comment-index row">
    <div class="col-12">
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
                <?php foreach ($comments as $comment):?>
                    <tr class="status-<?= $comment->status; ?>">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>

                        </td>
                        <td>
                            <?= Html::a('<i class="mdi mdi-note-text"></i>',
                                ['view', 'id' => $article->id],
                                ['title' => 'View']) ?>
                            <?= Html::a('<i class="mdi mdi-pencil-outline"></i>',
                                ['update', 'id' => $article->id],
                                ['title' => 'Update']) ?>
                            <?php if($comment->status == \yii2mod\moderation\enums\Status::APPROVED):?>
                                <?= Html::a('<i class="mdi mdi-eye-off"></i>',
                                    ['soft-delete', 'id' => $article->id],
                                    ['title' => 'Hide']) ?>
                            <?php elseif ($comment->status == \yii2mod\moderation\enums\Status::REJECTED): ?>
                                <?= Html::a('<i class="mdi mdi-eye"></i>',
                                    ['restore', 'id' => $article->id],
                                    ['title' => 'Restore']) ?>
                            <?php endif; ?>
                            <?php if ($rbacManager->haveAdminPermissions()):?>
                                <?= Html::a('<i class="mdi mdi-delete"></i>',
                                    ['delete', 'id' => $article->id],
                                    [
                                        'data' => ['method' => 'post', 'id' => $article->id],
                                        'title' => 'Delete',
                                        'class' => 'article-list-delete'
                                    ]) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
