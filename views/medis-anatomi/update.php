<?php

/* @var $this yii\web\View */
/* @var $model app\models\MedisAnatomi */

$this->title = 'Update Medis Anatomi: ' . $model->id_anatomi;
$this->params['breadcrumbs'][] = ['label' => 'Medis Anatomi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_anatomi, 'url' => ['view', 'id' => $model->id_anatomi]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form_edit', [
                        'model' => $model,
                        'anatomiall' => $anatomiall,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>