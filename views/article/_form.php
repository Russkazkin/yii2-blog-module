<?php

use app\modules\blog\models\Article;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $form yii\widgets\ActiveForm */
/* @var $today app\modules\blog\controllers\BaseController */
/* @var $categories Article[] */
/* @var $selectedTags Article[] */
/* @var $tags Article[] */
?>

<div class="article-form row">
    <div class="col-12">
        <div class="p-2">

            <?php $form = ActiveForm::begin([
                'layout'=>'horizontal',
                'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-2 col-form-label',
                        'wrapper' => 'col-sm-10',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
            ]); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'category_id')->dropDownList($categories,
                ['prompt' => Yii::t('app', 'Choose category...')]); ?>

            <?= $form->field($model, 'tags')->dropDownList($tags, ['multiple' => 'multiple']); ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'date')->widget(DatePicker::class, [
                'options' => ['value' => $today],
                'pluginOptions' => [
                    'autoclose' => true,
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
    </div>
</div>
