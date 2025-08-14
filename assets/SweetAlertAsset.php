<?php 

namespace app\assets;

use yii\web\AssetBundle;


class SweetAlertAsset extends AssetBundle
{
    public $sourcePath = '@bower/sweetalert';

    /**
     * @var array list of JavaScript files.
     */
    public $js = [
        'dist/sweetalert.min.js',
    ];

    /**
     * @var array list of CSS files.
     */
    public $css = [
        'dist/sweetalert.css'
    ];
}
?>