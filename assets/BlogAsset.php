<?php


namespace app\modules\blog\assets;


use yii\web\AssetBundle;

class BlogAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/blog/resources';

    public $css = [
        'css/animate.min.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/owl.transitions.css',
        'css/style.css',
        'css/responsive.css',
        'css/quill.css',
        'css/custom.css',
    ];
    public $js = [
        'js/owl.carousel.min.js',
        'js/jquery.stickit.min.js',
        'js/menu.js',
        'js/scripts.js',
    ];
    public $depends = [
            Bootstrap4Asset::class,
            FontAwesomeAsset::class,
        ];
}