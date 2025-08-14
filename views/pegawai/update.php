<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPegawai */

$this->title = 'Update Pegawai Pegawai: ' . $model->id_nip_nrp;
$this->params['breadcrumbs'][] = ['label' => 'Pegawai Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_nip_nrp, 'url' => ['view', 'id' => $model->id_nip_nrp]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pegawai-pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
