<?php

/* @var $this yii\web\View */
/* @var $model app\models\MedisTindakan */

$this->params['breadcrumbs'][] = ['label' => 'Medis Tindakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>

<div class="container-fluid">
    <div class="d-flex justify-content-center">    
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">Ubah Medis Tindakan</div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <?=$this->render('_form', [
                                'model' => $model,
                                'tindakan' => $tindakan,
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
</div>