<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPegawai */

$this->title = $model->id_nip_nrp;
$this->params['breadcrumbs'][] = ['label' => 'Pegawai Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pegawai-pegawai-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_nip_nrp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_nip_nrp], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pegawai_id',
            'id_nip_nrp',
            'nama_lengkap',
            'gelar_sarjana_depan',
            'gelar_sarjana_belakang',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'status_perkawinan',
            'agama',
            'alamat_tempat_tinggal',
            'rt_tempat_tinggal',
            'rw_tempat_tinggal',
            'desa_kelurahan',
            'kecamatan',
            'kabupaten_kota',
            'provinsi',
            'kode_pos',
            'no_telepon_1',
            'no_telepon_2',
            'golongan_darah',
            'status_kepegawaian_id',
            'jenis_kepegawaian_id',
            'npwp',
            'nomor_ktp',
            'nota_persetujuan_bkn_nomor_cpns',
            'nota_persetujuan_bkn_tanggal_cpns',
            'pejabat_yang_menetapkan_cpns',
            'sk_cpns_nomor_cpns',
            'sk_cpns_tanggal_cpns',
            'kode_pangkat_cpns',
            'tmt_cpns',
            'pejabat_yang_menetapkan_pns',
            'sk_nomor_pns',
            'sk_tanggal_pns',
            'kode_pangkat_pns',
            'tmt_pns',
            'sumpah_janji_pns',
            'tinggi_keterangan_badan',
            'berat_badan_keterangan_badan',
            'rambut_keterangan_badan',
            'bentuk_muka_keterangan_badan',
            'warna_kulit_keterangan_badan',
            'ciri_ciri_khas_keterangan_badan',
            'cacat_tubuh_keterangan_badan',
            'kegemaran_1',
            'kegemaran_2',
            'kegemaran_3',
            'photo:ntext',
            'status_aktif_pegawai',
            'tipe_user',
            'kode_dokter_maping_simrs',
            'niptk',
            'email:email',
            'tanda_tangan:ntext',
            'id_riwayat_penempatan_terakhir',
        ],
    ]) ?>

</div>
