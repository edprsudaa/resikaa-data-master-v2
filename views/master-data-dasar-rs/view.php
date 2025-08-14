<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MasterDataDasarRs */

// $this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Master Data Dasar Rs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-data-dasar-rs-view">

<section class="content">
    <div class="container-fluid">
        <div class="invoice p-3 mb-3">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <h4>
                                <i class="fas fa-globe"></i> DATA DASAR RUMAH SAKIT
                            </h4>
                        </div>
                        <div class="col">
                            <div class="div float-right d-flex">

                                <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?> 
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        
            <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                    Nomor Kode Rumah Sakit
                    <address>
                        <strong style="text-transform:UPPERCASE"><?= $model->nomor_kode_rs ?></strong><br>
                    </address>

                    Tanggal Registrasi
                    <address>
                        <strong style="text-transform:UPPERCASE"><?= $model->tanggal_registrasi ?></strong><br>
                    </address>

                    Nama Direktur Rumah Sakit
                    <address>
                        <strong style="text-transform:UPPERCASE"><?= $model->nama_direktur_rs ?></strong><br>
                    </address>
                </div>

                <div class="col-sm-3 invoice-col">
                    Nama Rumah Sakit
                    <address>
                        <strong style="text-transform:UPPERCASE"><?= $model->nama_rs ?></strong><br>
                    </address>

                    Jenis Rumah Sakit
                    <address>
                        <strong style="text-transform:UPPERCASE"><?= $model->jenis_rs ?></strong><br>
                    </address>

                    Kelas Rumah Sakit
                    <address>
                        <strong style="text-transform:UPPERCASE"><?= $model->kelas_rs ?></strong><br>
                    </address>
                </div>

                <div class="col-sm-3 invoice-col">
                    Nama Penyelenggara Rumah Sakit
                    <address>
                        <strong style="text-transform:UPPERCASE"><?= $model->nama_penyelenggara_swasta ?></strong><br>
                    </address>

                    Luas Rumah Sakit
                    <address style="margin-left:5px">
                        
                        - Luas Tanah: <b><?= $model->luas_tanah_rs?> Hektare</b><br>
                        - Luas Bangunan: <b><?= $model->luas_bangunan_rs?> Hektare</b><br>
                    </address>
                </div>

                <div class="col-sm-3 invoice-col">
                    Alamat
                    <address>
                        <b><?= $model->alamat_rs?></b><br>
                        <?= $model->kab_kota_rs?>, <?= $model->kode_pos_rs?><br>
                        Telepon : <b><?= $model->telepon_rs?></b><br>
                        Fax: <b><?= $model->fax_rs ?></b><br>
                        Email: <b><?= $model->email_rs ?></b><br>
                        Nomor Telpon Humas: <b><?= $model->nomor_telepon_bag_umum_rs ?></b><br>
                        Website: <b><?= $model->website_rs ?></b><br>
                    </address>
                </div>

            </div>

            <div class="row">

                <div class="col-6">
                    <p class="lead">Izin Rumah Sakit</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Nomor Surat Izin Rumah Sakit:</th>
                                <td><?= $model->nomor_surat_izin_rs ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Surat Izin Rumah Sakit</th>
                                <td><?= $model->tanggal_surat_izin_rs?></td>
                            </tr>
                            <tr>
                                <th>Surat Izin Dikeluarkan Oleh:</th>
                                <td><?= $model->surat_izin_rs_dikeluarkan_oleh?></td>
                            </tr>
                            <tr>
                                <th>Sifat Surat izin Rumah Sakit:</th>
                                <td><?= $model->sifat_surat_izin_rs?></td>
                            </tr>
                            <tr>
                                <th>Masa Berlaku Surat Izin Rumah Sakit:</th>
                                <td><?= $model->masa_berlaku_surat_izin_rs?></td>
                            </tr>
                            <tr>
                                <th>Status Penyelenggara Swasta Rumah Sakit:</th>
                                <td><?= $model->status_penyelenggara_swasta_rs?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-6">
                    <p class="lead">Akreditasi Rumah Sakit</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Akreditasi Rumah Sakit</th>
                                <td><?= $model->akreditasi_rs?></td>
                            </tr>
                            <tr>
                                <th>Pentahapan Akreditasi Rumah Sakit</th>
                                <td><?= $model->pentahapan_akreditasi_rs?></td>
                            </tr>
                            <tr>
                                <th>Status Akreditasi Rumah Sakit:</th>
                                <td><?= $model->status_akreditasi_rs?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Akreditasi Rumah Sakit:</th>
                                <td><?= $model->tanggal_akreditasi_rs?></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

</div>
