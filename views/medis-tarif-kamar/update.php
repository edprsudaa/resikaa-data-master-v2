<?php

/* @var $this yii\web\View */
/* @var $model app\models\MedisTarifKamar */

$this->title = 'Update Medis Tarif Kamar: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Medis Tarif Kamars', 'url' => ['index']];
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
                        'kamar' => $kamar,
                        'sk_tarif' => $sk_tarif,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>