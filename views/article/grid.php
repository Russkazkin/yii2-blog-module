<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\blog\models\search\ArticleSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\modules\blog\models\Article;

/* @var $this View */
/* @var $searchModel ArticleSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $data Article */

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
