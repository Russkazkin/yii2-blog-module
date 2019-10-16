<?php

use app\modules\blog\controllers\BaseController;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */
/* @var $form yii\widgets\ActiveForm */
/* @var $today app\modules\blog\controllers\BaseController */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

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
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
