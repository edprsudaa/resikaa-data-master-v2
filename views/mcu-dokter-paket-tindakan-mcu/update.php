<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\McuDokterPaketTindakanMcu */
?>
<div class="mcu-dokter-paket-tindakan-mcu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dokter' => $dokter,
        'paket_tindakan' => $paket_tindakan,
        'paket' => $paket,
    ]) ?>

</div>
