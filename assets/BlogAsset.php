<?php


namespace app\modules\blog\assets;


use yii\web\AssetBundle;

class BlogAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/blog/resources';

    public $css = [
        'css/font-awesome.min.css',
        'css/animate.min.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/owl.transitions.css',
        'css/style.css',
        'css/responsive.css.css',
    ];
    public $js = [
        'js/lang.js',
    ];
}