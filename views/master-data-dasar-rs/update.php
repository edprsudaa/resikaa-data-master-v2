<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MasterDataDasarRs */

$this->title = 'Update Data Dasar Rumah Sakit';
$this->params['breadcrumbs'][] = ['label' => 'Master Data Dasar Rs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-data-dasar-rs-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model'                         => $model,
        'jenisRumahSakit'               => $jenisRumahSakit,
        'kelasRumahSakit'               => $kelasRumahSakit,
        'statusPenyelenggaraSosial'     => $statusPenyelenggaraSosial,
        'kabupaten'                     => $kabupaten
    ]) ?>

</div>
