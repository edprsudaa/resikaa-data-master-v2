<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranKelompokUnitLayanan */

$this->title = 'Create Pendaftaran Kelompok Unit Layanan';
$this->params['breadcrumbs'][] = ['label' => 'Pendaftaran Kelompok Unit Layanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'unit' => $unit,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>