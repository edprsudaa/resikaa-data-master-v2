<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aplikasi */

$this->title = 'Tambah Aplikasi RSUD';
$this->params['breadcrumbs'][] = ['label' => 'Aplikasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aplikasi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
