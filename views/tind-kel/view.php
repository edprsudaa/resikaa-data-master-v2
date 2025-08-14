<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TindKel */
?>
<div class="tind-kel-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'KELOMPOK',
            'TINDAKAN',
            'KDKEL',
            'KODE1',
            'KODE2',
            'lPilih',
            'lHeader',
            'lManual',
            'FileReport',
            'Jenis',
            'Pajak',
            'Cyto',
            'lJumlah',
            'lCytoHarga_Bhn',
            'lCytoJs_RS',
            'lCytoJs_MedL',
            'lCytoJs_MedTL',
            'CytoHarga_Bhn',
            'CytoJs_RS',
            'CytoJs_MedL',
            'CytoJs_MedTL',
            'lReg',
            'lDrSpesialis',
            'KodeKelDokter',
            'lNonAktif',
            'KodeKelPely',
            'KodeKelPenerima_Rem',
            'Parent',
            'KodeRL_1_4',
            'KodeRL_1_5',
            'KodeRL_1_6',
            'KodeRL_1_7',
            'KodeRL_1_8',
            'KodeRL_1_9A',
            'KodeRL_1_9B',
            'KodeRL_1_9C',
            'KodeRL_1_9D',
            'KodeRL_1_10',
            'KodeRL_1_11A',
            'KodeRL_1_11B',
            'KodeRL_1_11C',
            'KodeRL_1_13',
            'KodeRL_1_14',
            'KodeRL_1_15',
            'KodeRL_1_16',
            'KodeRL_1_20A',
            'KodeRL_1_20B',
            'KodeRL_1_20C',
            'KodeRL_1_20D',
            'KodeRL_1_5_Kat',
            'KodeRL_1_11A_Kat',
            'KodeRL_1_11B_Kat',
        ],
    ]) ?>

</div>
