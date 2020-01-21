<?php

use app\modules\admin\assets\DataTablesAsset;
use app\modules\admin\assets\MagnificPopupAsset;
use app\modules\admin\assets\SweetalertAsset;
use app\modules\blog\Module;
use yii\helpers\Html;

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
    <div class="col-12">
        <p>
            <?= Html::a(Yii::t('blog', 'Create Comment'), ['create'], ['class' => 'btn btn-success btn-sm waves-effect width-md waves-light']) ?>
        </p>
        <div class="card-box">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                <tr>
                    <th><?=Module::t('blog', 'Text')?></th>
                    <th><?=Module::t('blog', 'Date')?></th>
                    <th><?=Module::t('blog', 'User')?></th>
                    <th><?=Module::t('blog', 'Article')?></th>
                    <th><?=Module::t('blog', 'Status')?></th>
                    <th><?=Module::t('blog', 'Actions')?></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php var_dump($comments); ?>
