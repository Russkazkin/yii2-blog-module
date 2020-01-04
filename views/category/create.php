<?php

use app\modules\admin\assets\FormAdvancedAsset;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Category */

$this->title = Yii::t('blog', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
FormAdvancedAsset::register($this);
?>
<div class="category-create row">
    <div class="col-12">
        <div class="card-box">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
