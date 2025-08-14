<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTindakan */


$this->params['breadcrumbs'][] = ['label' => 'Medis Tindakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="d-flex justify-content-center">    
        <div class="col-md-10">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> Tambah Medis Tindakan</h3>              
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?=$this->render('_form', [
                            'model'                 => $model,
                            'dataParent'            => $dataParent,
                            'modelTarifTindakan'    => $modelTarifTindakan,
                            'skTarifTindakan'       => $skTarifTindakan,
                            'kelasRawat'            => $kelasRawat,
                        ]) ?>
                    </div>
                </div>
            </div>
            <!--.card-body-->
        </div>
        </div>
    </div>
    <!--.card-->
</div>