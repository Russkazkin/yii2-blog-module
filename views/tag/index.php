<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\FormAdvancedAsset;
use app\modules\admin\assets\ModalAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\search\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Tags');
$this->params['breadcrumbs'][] = $this->title;
DataTablesAsset::register($this);
SweetalertAsset::register($this);
ModalAsset::register($this);
FormAdvancedAsset::register($this);
?>
<div class="tag-index">

    <p>
        <a href="#create-tag-modal"
           class="btn btn-success btn-sm waves-effect width-md waves-light"
           data-animation="fadein"
           data-plugin="custommodal"
           data-overlayColor="#36404a"><?= Module::t('blog', 'Create Category')?>
        </a>
    </p>
</div>
