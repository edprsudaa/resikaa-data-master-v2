<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\McuPaketTindakanMcu */
?>
<div class="mcu-paket-tindakan-mcu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'paket' => $paket,
        'unit' => $unit,
    ]) ?>

</div>
