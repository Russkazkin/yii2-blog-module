<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\models\Comment;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii2mod\moderation\enums\Status;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\search\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $comments Comment[] */

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
                    <th><?=Module::t('blog', 'Content')?></th>
                    <th><?=Module::t('blog', 'Author')?></th>
                    <th><?=Module::t('blog', 'Article')?></th>
                    <th><?=Module::t('blog', 'Date')?></th>
                    <th><?=Module::t('blog', 'Status')?></th>
                    <th><?=Module::t('blog', 'Actions')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comments as $comment):?>
                    <tr class="status-<?= $comment->status; ?>">
                        <td> <?= Html::a(StringHelper::truncate($comment->content, 20), [
                                'blog/single',
                                'id' => $comment->article->id,
                                '#' => 'comment-' . $comment->id,
                                ]) ?></td>
                        <td><?= $comment->author->username; ?></td>
                        <td>
                            <?= Html::a(StringHelper::truncate($comment->article->title, 20), [
                                'blog/single',
                                'id' => $comment->article->id]) ?>
                        </td>
                        <td>
                            <?= $comment->timestampToDatetime(); ?>
                        </td>
                        <td>
                            <?= Status::$list[$comment->status] ?>
                        </td>
                        <td>
                            <?= Html::a('<i class="mdi mdi-note-text"></i>',
                                ['view', 'id' => $comment->id],
                                ['title' => 'View']) ?>
                            <?= Html::a('<i class="mdi mdi-pencil-outline"></i>',
                                ['update', 'id' => $comment->id],
                                ['title' => 'Update']) ?>
                            <?php if($comment->status == Status::APPROVED):?>
                                <?= Html::a('<i class="mdi mdi-clock-alert"></i>',
                                    ['status', 'id' => $comment->id, 'status' => STATUS::PENDING],
                                    ['title' => 'Set PENDING status']) ?>
                            <?php elseif ($comment->status !== Status::APPROVED): ?>
                                <?= Html::a('<i class="mdi mdi-check-decagram"></i>',
                                    ['status', 'id' => $comment->id, 'status' => STATUS::APPROVED],
                                    ['title' => 'Approve']) ?>
                            <?php endif; ?>
                            <?= Html::a('<i class="mdi mdi-cancel"></i>',
                                ['status', 'id' => $comment->id, 'status' => STATUS::REJECTED],
                                ['title' => 'Reject']) ?>
                            <?= Html::a('<i class="mdi mdi-lock-clock"></i>',
                                ['status', 'id' => $comment->id, 'status' => STATUS::POSTPONED],
                                ['title' => 'Postpone']) ?>
                            <?php if ($rbacManager->haveAdminPermissions()):?>
                                <?= Html::a('<i class="mdi mdi-delete"></i>',
                                    ['delete', 'id' => $comment->id],
                                    [
                                        'data' => ['method' => 'post', 'id' => $comment->id],
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
