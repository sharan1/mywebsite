<?php namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{

    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
    public $css = [
        'css/AdminLTE.css',
        'css/skins/skin-red.css'
    ];
    public $js = [
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\BootstrapAsset',
        'app\assets\FontawesomeAsset',
    ];

}
