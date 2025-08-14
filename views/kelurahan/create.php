<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kelurahan */

$this->title = 'Tambah Kelurahan/Desa';
$this->params['breadcrumbs'][] = ['label' => 'Kelurahan/Desa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="col-md-6">
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
</div>