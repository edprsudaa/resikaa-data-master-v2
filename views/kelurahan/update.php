<?php

/* @var $this yii\web\View */
/* @var $model app\models\Kelurahan */

$this->title = 'Ubah Kelurahan/Desa ' . $model->kode_prov_kab_kec_kelurahan;
$this->params['breadcrumbs'][] = ['label' => 'Kelurahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_prov_kab_kec_kelurahan, 'url' => ['view', 'id' => $model->kode_prov_kab_kec_kelurahan]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="col-md-6">
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
    </div>
    <!--.card-->
</div>