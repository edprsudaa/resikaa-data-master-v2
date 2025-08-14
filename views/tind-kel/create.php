<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TindKel */

?>
<div class="tind-kel-create">
    <?= $this->render('_form', [
        'model' => $model,
        'tindkel' => $tindkel,
        'model_kelas' => $model_kelas,
    ]) ?>
</div>
