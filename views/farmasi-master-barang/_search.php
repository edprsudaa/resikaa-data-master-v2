<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiMasterBarangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row mt-2">
    <div class="col-md-12">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_barang') ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'is_deleted')->checkbox() ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'riwayat') ?>

    <?php // echo $form->field($model, 'kode_barang') ?>

    <?php // echo $form->field($model, 'nama_barang') ?>

    <?php // echo $form->field($model, 'nama_generik') ?>

    <?php // echo $form->field($model, 'id_satuan') ?>

    <?php // echo $form->field($model, 'id_kemasan') ?>

    <?php // echo $form->field($model, 'tipe_barang') ?>

    <?php // echo $form->field($model, 'id_kelompok') ?>

    <?php // echo $form->field($model, 'id_jenis') ?>

    <?php // echo $form->field($model, 'id_sub_jenis') ?>

    <?php // echo $form->field($model, 'id_golongan') ?>

    <?php // echo $form->field($model, 'id_klasifikasi') ?>

    <?php // echo $form->field($model, 'retriksi') ?>

    <?php // echo $form->field($model, 'deskripsi') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'isi_per_kemasan') ?>

    <?php // echo $form->field($model, 'harga_kemasan') ?>

    <?php // echo $form->field($model, 'harga_satuan_terakhir') ?>

    <?php // echo $form->field($model, 'harga_satuan_tertinggi') ?>

    <?php // echo $form->field($model, 'is_ppn')->checkbox() ?>

    <?php // echo $form->field($model, 'total_ppn') ?>

    <?php // echo $form->field($model, 'diskon_persen') ?>

    <?php // echo $form->field($model, 'stok_max') ?>

    <?php // echo $form->field($model, 'stok_min') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <!--.col-md-12-->
</div>
