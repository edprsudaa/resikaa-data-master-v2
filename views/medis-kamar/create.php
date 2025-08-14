<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MedisKamar */

$this->title = 'Create Medis Kamar';
$this->params['breadcrumbs'][] = ['label' => 'Medis Kamars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'unit' => $unit,
                        'kelas_rawat' => $kelas_rawat,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>