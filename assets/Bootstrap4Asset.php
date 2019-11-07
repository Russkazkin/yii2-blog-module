<?php


namespace app\modules\blog\assets;


use yii\web\AssetBundle;

class Bootstrap4Asset extends AssetBundle
{
    public $sourcePath = '@npm/bootstrap/dist';
    public $css = [
        'css/bootstrap.css',
    ];
    public $js = [
        'js/bootstrap.js',
    ];
}