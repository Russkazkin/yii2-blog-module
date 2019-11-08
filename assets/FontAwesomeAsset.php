<?php


namespace app\modules\blog\assets;


use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/fontawesome';

    public $js = [
        'js/all.js',
    ];
}