<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/';
    public $css = [
        'theme/adminlte3/plugins/fontawesome-free/css/all.min.css',
        'theme/adminlte3/dist/css/adminlte.min.css',
        'theme/adminlte3/plugins/pace-progress/themes/black/pace-theme-flat-top.css'
    ];
    public $js = [
        'theme/adminlte3/dist/js/adminlte.min.js',
        '//cdn.jsdelivr.net/npm/sweetalert2@11',
        'js/keperluan.js',
        'js/site.js',
        'js/yii-overide.js',
        'js/alert.js',
    ];
    public $jsOptions = [
    'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'app\assets\VueAssets',
        'app\assets\SweetAlertAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
