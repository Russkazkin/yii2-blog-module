<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-form row">
    <div class="col-12">
        <div class="p-2">

            <?php $form = ActiveForm::begin([
                'layout'=>'horizontal',
                'options' => ['class' => 'form-horizontal'],
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

            <?= $form->field($model, 'title')->textInput(['maxlength' => 32]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('blog', 'Save'), ['class' => 'btn btn-success btn-sm waves-effect width-md waves-light']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
