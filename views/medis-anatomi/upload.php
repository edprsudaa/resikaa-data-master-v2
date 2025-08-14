<?php

/* @var $this yii\web\View */
/* @var $model app\models\MedisAnatomi */

$this->title = 'Upload Medis Anatomi: ' . $model->id_anatomi;
$this->params['breadcrumbs'][] = ['label' => 'Medis Anatomis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_anatomi, 'url' => ['view', 'id' => $model->id_anatomi]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form_upload', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>