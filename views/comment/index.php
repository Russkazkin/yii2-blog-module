<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var $this yii\web\View
 * @var $comments \app\modules\blog\models\Comment []
 */

$this->title = Module::t('blog', 'Comments');
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
SweetalertAsset::register($this);
MagnificPopupAsset::register($this);
?>
<div class="comment-index row">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('blog', 'Create Comment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php var_dump($comments); ?>

</div>
