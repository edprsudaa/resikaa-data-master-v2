<?php

/* @var $this yii\web\View */
/* @var $model app\models\Kabupaten */

$this->title = 'Update Kabupaten: ' . $model->kode_prov_kabupaten;
$this->params['breadcrumbs'][] = ['label' => 'Kabupaten', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_prov_kabupaten, 'url' => ['view', 'id' => $model->kode_prov_kabupaten]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'provinsi'  => $provinsi
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>