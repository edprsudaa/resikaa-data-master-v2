<?php

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranLoketUnit */

$this->title = 'Update Pendaftaran Loket Unit: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pendaftaran Loket Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'loket' => $loket,
                        'unit' => $unit,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>