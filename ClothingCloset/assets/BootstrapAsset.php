<?php namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{

    public $sourcePath = '@bower/bootstrap/dist';
    public $css = true ? [
            'css/bootstrap.css',
            'css/bootstrap-theme.css'
            ] : [];
    public $js = [
        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
