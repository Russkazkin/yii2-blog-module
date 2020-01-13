<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/** @var $this yii\web\View
 * @var $articles \app\modules\blog\models\Article []
 * @var $rbacManager \app\modules\auth\components\RbacComponent
 * @var $articleComponent \app\modules\blog\components\ArticleComponent
 */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
SweetalertAsset::register($this);
MagnificPopupAsset::register($this);
?>

<div class="row">
    <div class="col-12">
        <p>
            <?= Html::a(Module::t('blog', 'Create Article'), ['create'], ['class' => 'btn btn-success btn-sm waves-effect width-md waves-light']) ?>
        </p>
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
                <?php if (!$rbacManager->canViewArticle($article)) continue; ?>
                <tr class="status-<?= $article->status; ?>">
                    <td><?= StringHelper::truncate($article->title, 40); ?></td>
                    <td><?= $article->category->title; ?></td>
                    <td><?= $article->timestampToDate(); ?></td>
                    <td><?= $article->getSelectedTagsTitle(); ?></td>
                    <td>
                        <a href="<?= $articleComponent->getImage($article) ?>" class="article-list-img-link">
                            <img src="<?= $articleComponent->getImage($article) ?>"
                             alt="<?= $article->title; ?> img"
                             height="20">
                        </a>
                    </td>
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
                        <?php if ($rbacManager->canDeleteArticle($article)):?>
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