<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\FormAdvancedAsset;
use app\modules\admin\assets\ModalAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $categories \app\modules\blog\models\Category [] */
/* @var $rbacManager \app\modules\auth\components\RbacComponent */

$this->title = Yii::t('blog', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
SweetalertAsset::register($this);
ModalAsset::register($this);
FormAdvancedAsset::register($this);
?>
<div class="category-index row">
    <div class="col-12">
        <p>
            <a href="#create-category-modal"
               class="btn btn-success btn-sm waves-effect width-md waves-light"
               data-animation="fadein"
               data-plugin="custommodal"
               data-overlayColor="#36404a"><?= Module::t('blog', 'Create Category')?>
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
                <?php foreach ($categories as $category):?>
                    <tr class="status-<?= $category->status; ?>">
                        <td><?= $category->title; ?></td>
                        <td>
                            <?= Html::a('<i class="mdi mdi-note-text"></i>',
                                ['view', 'id' => $category->id],
                                ['title' => 'View']) ?>
                            <?= Html::a('<i class="mdi mdi-pencil-outline"></i>',
                                ['update', 'id' => $category->id],
                                ['title' => 'Update']) ?>
                            <?php if($category->status == $category::STATUS_ACTIVE):?>
                                <?= Html::a('<i class="mdi mdi-eye-off"></i>',
                                    ['soft-delete', 'id' => $category->id],
                                    ['title' => 'Hide']) ?>
                            <?php elseif ($category->status == $category::STATUS_DELETED): ?>
                                <?= Html::a('<i class="mdi mdi-eye"></i>',
                                    ['restore', 'id' => $category->id],
                                    ['title' => 'Restore']) ?>
                            <?php endif; ?>
                            <?php if ($rbacManager->haveAdminPermissions()):?>
                                <?= Html::a('<i class="mdi mdi-delete"></i>',
                                    ['delete', 'id' => $category->id],
                                    [
                                        'data' => ['method' => 'post', 'id' => $category->id],
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
<!-- Modal -->
<div id="create-category-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title"><?= Module::t('blog', 'Create Category')?></h4>
    <div class="custom-modal-text">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
