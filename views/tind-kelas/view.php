<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TindKelas */
?>
<div class="tind-kelas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'KDKEL',
            'KODE1',
            'KODE2',
            'KodeKelas',
            'Harga_Bhn',
            'Js_RS',
            'Js_MedRS',
            'Js_MedL',
            'Js_MedTL',
            'Js_KSO',
            'lPilih',
        ],
    ]) ?>

</div>
