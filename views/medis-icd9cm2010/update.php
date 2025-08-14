<?php

/* @var $this yii\web\View */
/* @var $model app\models\MedisIcd9cm */

$this->title = 'Update Medis Icd9cm 2010: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Medis Icd9cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'kode' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>