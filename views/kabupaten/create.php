<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kabupaten */

$this->title = 'Tambah Kabupaten/Kota';
$this->params['breadcrumbs'][] = ['label' => 'Kabupaten', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="col-6">
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