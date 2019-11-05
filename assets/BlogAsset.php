<?php


namespace app\modules\blog\assets;


use yii\web\AssetBundle;

class BlogAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/blog/resources';

    public $css = [
        'css/lang.css',
    ];
    public $js = [
        'js/lang.js',
    ];
}