<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-pegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'pegawai_id') ?>

    <?= $form->field($model, 'id_nip_nrp') ?>

    <?= $form->field($model, 'nama_lengkap') ?>

    <?= $form->field($model, 'gelar_sarjana_depan') ?>

    <?= $form->field($model, 'gelar_sarjana_belakang') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'tanggal_lahir') ?>

    <?php // echo $form->field($model, 'jenis_kelamin') ?>

    <?php // echo $form->field($model, 'status_perkawinan') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'alamat_tempat_tinggal') ?>

    <?php // echo $form->field($model, 'rt_tempat_tinggal') ?>

    <?php // echo $form->field($model, 'rw_tempat_tinggal') ?>

    <?php // echo $form->field($model, 'desa_kelurahan') ?>

    <?php // echo $form->field($model, 'kecamatan') ?>

    <?php // echo $form->field($model, 'kabupaten_kota') ?>

    <?php // echo $form->field($model, 'provinsi') ?>

    <?php // echo $form->field($model, 'kode_pos') ?>

    <?php // echo $form->field($model, 'no_telepon_1') ?>

    <?php // echo $form->field($model, 'no_telepon_2') ?>

    <?php // echo $form->field($model, 'golongan_darah') ?>

    <?php // echo $form->field($model, 'status_kepegawaian_id') ?>

    <?php // echo $form->field($model, 'jenis_kepegawaian_id') ?>

    <?php // echo $form->field($model, 'npwp') ?>

    <?php // echo $form->field($model, 'nomor_ktp') ?>

    <?php // echo $form->field($model, 'nota_persetujuan_bkn_nomor_cpns') ?>

    <?php // echo $form->field($model, 'nota_persetujuan_bkn_tanggal_cpns') ?>

    <?php // echo $form->field($model, 'pejabat_yang_menetapkan_cpns') ?>

    <?php // echo $form->field($model, 'sk_cpns_nomor_cpns') ?>

    <?php // echo $form->field($model, 'sk_cpns_tanggal_cpns') ?>

    <?php // echo $form->field($model, 'kode_pangkat_cpns') ?>

    <?php // echo $form->field($model, 'tmt_cpns') ?>

    <?php // echo $form->field($model, 'pejabat_yang_menetapkan_pns') ?>

    <?php // echo $form->field($model, 'sk_nomor_pns') ?>

    <?php // echo $form->field($model, 'sk_tanggal_pns') ?>

    <?php // echo $form->field($model, 'kode_pangkat_pns') ?>

    <?php // echo $form->field($model, 'tmt_pns') ?>

    <?php // echo $form->field($model, 'sumpah_janji_pns') ?>

    <?php // echo $form->field($model, 'tinggi_keterangan_badan') ?>

    <?php // echo $form->field($model, 'berat_badan_keterangan_badan') ?>

    <?php // echo $form->field($model, 'rambut_keterangan_badan') ?>

    <?php // echo $form->field($model, 'bentuk_muka_keterangan_badan') ?>

    <?php // echo $form->field($model, 'warna_kulit_keterangan_badan') ?>

    <?php // echo $form->field($model, 'ciri_ciri_khas_keterangan_badan') ?>

    <?php // echo $form->field($model, 'cacat_tubuh_keterangan_badan') ?>

    <?php // echo $form->field($model, 'kegemaran_1') ?>

    <?php // echo $form->field($model, 'kegemaran_2') ?>

    <?php // echo $form->field($model, 'kegemaran_3') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'status_aktif_pegawai') ?>

    <?php // echo $form->field($model, 'tipe_user') ?>

    <?php // echo $form->field($model, 'kode_dokter_maping_simrs') ?>

    <?php // echo $form->field($model, 'niptk') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'tanda_tangan') ?>

    <?php // echo $form->field($model, 'id_riwayat_penempatan_terakhir') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
