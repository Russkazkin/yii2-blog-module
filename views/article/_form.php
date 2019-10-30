<?php

use app\modules\blog\controllers\BaseController;
use app\modules\blog\models\Article;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $form yii\widgets\ActiveForm */
/* @var $today app\modules\blog\controllers\BaseController */
/* @var $categories Article[] */
/* @var $selectedTags Article[] */
/* @var $tags Article[] */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories,
        ['prompt' => Yii::t('app', 'Choose category...')]); ?>

    <?= Html::label('Tags', 'tags', ['class' => 'label tags']) ?>

    <?= Html::dropDownList('tags', [], $tags, ['class' => 'form-control', 'multiple' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::class, [
        'options' => ['value' => $today],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => $model->format,
        ]
    ]); ?>

    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'language' => 'ru',
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'showUpload' => false,
            'showClose' => false,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
