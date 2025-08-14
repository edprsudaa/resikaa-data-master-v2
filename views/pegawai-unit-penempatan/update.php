<?php

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiUnitPenempatan */

$this->title = 'Update Unit Penempatan: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Unit Penempatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'unit_rumpun' => $unit_rumpun
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>