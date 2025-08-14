<?php

/* @var $this yii\web\View */
/* @var $model app\models\MedisMasalahKeperawatan */

$this->title = 'Update Medis Masalah Keperawatan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Medis Masalah Keperawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
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
    <!--.card-->
</div>