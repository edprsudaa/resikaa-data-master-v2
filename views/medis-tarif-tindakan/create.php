<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTarifTindakan */

$this->title = 'Create Medis Tarif Tindakan';
$this->params['breadcrumbs'][] = ['label' => 'Medis Tarif Tindakans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'tindakan' => $tindakan,
                        'kelas_rawat' => $kelas_rawat,
                        'sk_tarif' => $sk_tarif,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>