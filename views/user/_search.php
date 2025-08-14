<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AkunAknUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akun-akn-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row row-sm">
        <div class="col-sm-6">
            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Cari Berdasarkan Username']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'nama')->textInput(['placeholder'=>'Cari Berdasarkan Nama']) ?>
        </div>
    </div>
    <?php $form->field($model, 'userid') ?>

    <?php $form->field($model, 'id_pegawai') ?>


    <?php $form->field($model, 'password') ?>


    <?php // echo $form->field($model, 'tanggal_pendaftaran') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'token_aktivasi') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="fa fa-search"></span> Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<span class="fa fa-spinner"></span> Reset', ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="fa fa-plus"></span> Tambah Akun', ['create'], ['class' => 'btn btn-success btn-flat']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
