<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MasterDataDasarRsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-data-dasar-rs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomor_kode_rs') ?>

    <?= $form->field($model, 'tanggal_registrasi') ?>

    <?= $form->field($model, 'nama_rs') ?>

    <?= $form->field($model, 'jenis_rs') ?>

    <?php // echo $form->field($model, 'kelas_rs') ?>

    <?php // echo $form->field($model, 'nama_direktur_rs') ?>

    <?php // echo $form->field($model, 'nama_penyelenggara_swasta') ?>

    <?php // echo $form->field($model, 'alamat_rs') ?>

    <?php // echo $form->field($model, 'kab_kota_rs') ?>

    <?php // echo $form->field($model, 'kode_pos_rs') ?>

    <?php // echo $form->field($model, 'telepon_rs') ?>

    <?php // echo $form->field($model, 'fax_rs') ?>

    <?php // echo $form->field($model, 'email_rs') ?>

    <?php // echo $form->field($model, 'nomor_telepon_bag_umum_rs') ?>

    <?php // echo $form->field($model, 'website_rs') ?>

    <?php // echo $form->field($model, 'luas_tanah_rs') ?>

    <?php // echo $form->field($model, 'luas_bangunan_rs') ?>

    <?php // echo $form->field($model, 'nomor_surat_izin_rs') ?>

    <?php // echo $form->field($model, 'tanggal_surat_izin_rs') ?>

    <?php // echo $form->field($model, 'surat_izin_rs_dikeluarkan_oleh') ?>

    <?php // echo $form->field($model, 'sifat_surat_izin_rs') ?>

    <?php // echo $form->field($model, 'masa_berlaku_surat_izin_rs') ?>

    <?php // echo $form->field($model, 'status_penyelenggara_swasta_rs') ?>

    <?php // echo $form->field($model, 'akreditasi_rs') ?>

    <?php // echo $form->field($model, 'pentahapan_akreditasi_rs') ?>

    <?php // echo $form->field($model, 'status_akreditasi_rs') ?>

    <?php // echo $form->field($model, 'tanggal_akreditasi_rs') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
