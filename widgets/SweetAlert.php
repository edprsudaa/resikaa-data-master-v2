<?php

namespace app\widgets;

use Yii;

class SweetAlert extends \yii\bootstrap4\Widget
{
    // public $alertTypes = [
    //     'error' => 'alert-danger',
    //     'danger' => 'alert-danger',
    //     'success' => 'alert-success',
    //     'info' => 'alert-info',
    //     'warning' => 'alert-warning'
    // ];

    // public $closeButton = [];

    public function init()
    {
        parent::init();

        if (Yii::$app->session->hasFlash($type = 'success')) {
            // echo '<div class="alert alert-success">';
            $alert = Yii::$app->session->getFlash($type);
            $hasFlash = Yii::$app->session->hasFlash($type);
            echo '<div class="flashSuccess-data" data-alert="' . $type . '" data-value="' . $alert . '" data-flashdata="' . $hasFlash . '">';
            echo '</div>';
        } else if (Yii::$app->session->hasFlash($type = 'error')) {
            $alert = Yii::$app->session->getFlash($type);
            $hasFlash = Yii::$app->session->hasFlash($type);
            echo '<div class="flashSuccess-data" data-alert="' . $type . '" data-value="' . $alert . '" data-flashdata="' . $hasFlash . '">';
            echo '</div>';
        }
    }
}
