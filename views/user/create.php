<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AkunAknUser */
/* @var $dataPegawai app\models\TbPegawai */

$this->title = 'Tambah Akun Identitas';
$this->params['breadcrumbs'][] = ['label' => 'Akun Identitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akun-akn-user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
