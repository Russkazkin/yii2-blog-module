<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\FormAdvancedAsset;
use app\modules\admin\assets\ModalAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $tags \app\modules\blog\models\Tag[]
 * @var $rbacManager \app\modules\auth\components\RbacComponent
 */


$this->title = Yii::t('blog', 'Tags');
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
SweetalertAsset::register($this);
ModalAsset::register($this);
FormAdvancedAsset::register($this);
?>
<div class="tag-index">

    <p>
        <a href="#create-tag-modal"
           class="btn btn-success btn-sm waves-effect width-md waves-light"
           data-animation="fadein"
           data-plugin="custommodal"
           data-overlayColor="#36404a"><?= Module::t('blog', 'Create Tag')?>
        </a>
    </p>
    <div class="card-box">
        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
            <thead>
            <tr>
                <th><?=Module::t('blog', 'Name')?></th>
                <th><?=Module::t('blog', 'Actions')?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tags as $tag):?>
                <tr class="status-<?= $tag->status; ?>">
                    <td><?= $tag->title; ?></td>
                    <td>
                        <?= Html::a('<i class="mdi mdi-note-text"></i>',
                            ['view', 'id' => $tag->id],
                            ['title' => 'View']) ?>
                        <?= Html::a('<i class="mdi mdi-pencil-outline"></i>',
                            ['update', 'id' => $tag->id],
                            ['title' => 'Update']) ?>
                        <?php if($tag->status == $tag::STATUS_ACTIVE):?>
                            <?= Html::a('<i class="mdi mdi-eye-off"></i>',
                                ['soft-delete', 'id' => $tag->id],
                                ['title' => 'Hide']) ?>
                        <?php elseif ($tag->status == $tag::STATUS_DELETED): ?>
                            <?= Html::a('<i class="mdi mdi-eye"></i>',
                                ['restore', 'id' => $tag->id],
                                ['title' => 'Restore']) ?>
                        <?php endif; ?>
                        <?php if ($rbacManager->haveAdminPermissions()):?>
                            <?= Html::a('<i class="mdi mdi-delete"></i>',
                                ['delete', 'id' => $tag->id],
                                [
                                    'data' => ['method' => 'post', 'id' => $tag->id],
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
<!-- Modal -->
<div id="create-tag-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title"><?= Module::t('blog', 'Create Tag')?></h4>
    <div class="custom-modal-text">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
