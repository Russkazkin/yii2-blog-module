<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $data \app\modules\blog\models\Article */
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
        <div class="card-box">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                <tr>
                    <th>Actions</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Tags</th>
                    <th>Image</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($articles as $article):?>
                <tr>
                    <td></td>
                    <td><?= $article->title; ?></td>
                    <td><?= $article->category->title; ?></td>
                    <td><?= $article->timestampToDate(); ?></td>
                    <td><?= $article->getSelectedTagsTitle(); ?></td>
                    <td><?= $article->getImage(); ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>