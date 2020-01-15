<?php

use app\modules\blog\models\Article;
use bizley\quill\Quill;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

FontAwesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $form yii\bootstrap4\ActiveForm */
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

            <div class="row form-group">
                <?= Html::label('Tags', 'tags', ['class' => 'label tags col-sm-2 col-form-label']) ?>
                <div class="col-sm-10">
                    <?= Html::dropDownList(
                        'tags',
                        [],
                        $tags,
                        ['id' => 'article-tags', 'class' => 'form-control', 'multiple' => true])
                    ?>
                </div>
            </div>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->widget(Quill::class, [
//            <?= $form->field($model, 'content')->widget(\app\modules\blog\widgets\QuillLocal::class, [
                'theme' => 'snow',
                'toolbarOptions' => [
                    [['font' => []], ['size' => []]],
                    ['bold', 'italic', 'underline', 'strike'],
                    [['color' => []], ['background' => []]],
                    [['script' => 'super'], ['script' => 'sub']],
                    [['header' => [!1, 1, 2, 3, 4, 5, 6]], 'blockquote', 'code-block'],
                    [['list' => 'ordered'], ['list' => 'bullet'], ['indent' => '-1'], ['indent' => '+1']],
                    ['direction', ['align' => []]],
                    ['link', 'image', 'video', 'formula'],
                    ['clean'],
                ],
                'options' => [
                    'style' => 'min-height:300px;'
                ],
                'modules' => [
                    'formula' => true,
                    'syntax' => true,
                ],
                'localAssets' => true,
            ]) ?>
            <?/*= $form->field($model, 'content')->widget(CKEditor::class,[
                'editorOptions' => [
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]); */?>

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
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-sm waves-effect width-md waves-light']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
