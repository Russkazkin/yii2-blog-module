<?php

use app\modules\admin\assets\DataTablesAsset;
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
<div class="article-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'tableOptions' => ['class' => ]
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'title',
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
            'description:ntext',
            //'content:ntext',
            'date:date',
            [
                'attribute' => 'image',
                'format' => 'html',
                'label' => Yii::t('app', 'Image'),
                'value' => function($data){
                    return Html::img($data->getImage(), ['height' => '50']);
                },
            ],
            //'viewed',
            //'user_id',
            //'status',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php //var_dump($articles); ?>
<div class="row">
        <div class="col-12">
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
                        <td><?= $article->date; ?></td>
                        <td><?= $article->tags; ?></td>
                        <td><?= $article->getImage(); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>