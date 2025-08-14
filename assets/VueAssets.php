<?php
/**
 * Created by PhpStorm.
 * User: fauzizone
 * Date: 15/01/20
 * Time: 14:10
 */

namespace app\assets;

use yii\web\AssetBundle;

class VueAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/';

    // public $js = [
    //     'js/vue.min.js',
    //     'js/axios.min.js'
    // ];
    // public $depends = [];
    // public $publishOptions = [
    //     'only' => [
    //         '*.js',
    //     ]
    // ];
}