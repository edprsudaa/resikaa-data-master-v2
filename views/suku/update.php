<?php

/* @var $this yii\web\View */
/* @var $model app\models\Suku */

$this->title = 'Ubah Suku ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Sukus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?=$this->render('_form', [
                            'model' => $model
                        ]) ?>
                    </div>
                </div>
            </div>
            <!--.card-body-->
        </div>
    </div>
    
    <!--.card-->
</div>