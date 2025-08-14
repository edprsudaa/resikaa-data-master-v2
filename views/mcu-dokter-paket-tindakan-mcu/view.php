<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\McuDokterPaketTindakanMcu */
?>
<div class="mcu-dokter-paket-tindakan-mcu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_paket_tindakan_mcu',
            'tanggal',
            'kode_dokter',
        ],
    ]) ?>

</div>
