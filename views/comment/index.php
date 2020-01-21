<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/** @var $this yii\web\View
 * @var $comments \app\modules\blog\models\Comment []
 */

$this->title = Module::t('blog', 'Comments');
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
SweetalertAsset::register($this);
MagnificPopupAsset::register($this);
?>
<div class="comment-index row">
    <div class="col-12">
        <p>
            <?= Html::a(Yii::t('blog', 'Create Comment'), ['create'], ['class' => 'btn btn-success btn-sm waves-effect width-md waves-light']) ?>
        </p>
        <div class="card-box">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                <tr>
                    <th><?=Module::t('blog', 'Text')?></th>
                    <th><?=Module::t('blog', 'Date')?></th>
                    <th><?=Module::t('blog', 'User')?></th>
                    <th><?=Module::t('blog', 'Article')?></th>
                    <th><?=Module::t('blog', 'Status')?></th>
                    <th><?=Module::t('blog', 'Actions')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr class="status-<?= $comment->status; ?>">
                    <td><?= StringHelper::truncate($comment->text, 40); ?></td>
                    <td><?= $comment->created_at; ?></td>
                    <td><?= $comment->user->name; ?></td>
                    <td><?= $comment->article->title; ?></td>
                    <td><?= $comment->status; ?></td>
                    <td>
                        <?= Html::a('<i class="mdi mdi-note-text"></i>',
                            ['view', 'id' => $comment->id],
                            ['title' => 'View']) ?>
                        <?= Html::a('<i class="mdi mdi-pencil-outline"></i>',
                            ['update', 'id' => $comment->id],
                            ['title' => 'Update']) ?>
                        <?php if($comment->status == $comment::STATUS_ACTIVE):?>
                            <?= Html::a('<i class="mdi mdi-eye-off"></i>',
                                ['soft-delete', 'id' => $comment->id],
                                ['title' => 'Hide']) ?>
                        <?php elseif ($comment->status == $comment::STATUS_DELETED): ?>
                            <?= Html::a('<i class="mdi mdi-eye"></i>',
                                ['restore', 'id' => $category->id],
                                ['title' => 'Restore']) ?>
                        <?php endif; ?>
                        <?php if ($rbacManager->haveAdminPermissions()):?>
                            <?= Html::a('<i class="mdi mdi-delete"></i>',
                                ['delete', 'id' => $comment->id],
                                [
                                    'data' => ['method' => 'post', 'id' => $comment->id],
                                    'title' => 'Delete',
                                    'class' => 'category-list-delete'
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
