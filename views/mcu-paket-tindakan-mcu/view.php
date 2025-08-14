<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\McuPaketTindakanMcu */
?>
<div class="mcu-paket-tindakan-mcu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kode_paket',
            'kode_tindakan',
            'kode_unit',
            'nama_tabel:ntext',
            'nama_kolom1:ntext',
            'nama_kolom2:ntext',
            'nama_tindakan',
            'harga',
        ],
    ]) ?>

</div>
