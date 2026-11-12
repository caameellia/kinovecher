<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'assets/css/style.css',
    ];

    public $js = [
        'assets/js/app.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}