<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\MasterDataDasarRs */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="master-rumah-sakit-form">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">

                                <div class="col-sm-6">
                                    <!-- <h3 class="card-title"><?= Html::encode($this->title) ?></h3> -->
                                </div>
                                <div class="col-sm-6">
                                    <p class="float-sm-right">

                                     <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-primary']) ?>
                                       
                                       
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <?php $form = ActiveForm::begin(); ?>    
        
                                <div class="row">
                                    <div class="col">
                                        <?= $form->field($model, 'nomor_kode_rs')->textInput()->label('Kode Rumah Sakit') ?>
                                    </div>
                                    <div class="col">
                                        <?= 
                                            $form->field($model, 'tanggal_registrasi')->widget(DatePicker::classname(), [
                                                'options' => ['placeholder' => 'Tanggal Registrasi ...'],
                                                'pluginOptions' => [
                                                    'autoclose' => true,
                                                    'format' => 'dd-M-yyyy'
                                                ],
                                            ])->label('Tanggal Registrasi Rumah Sakit'); 
                                        ?> 
                                    </div>
                                    
                                    <div class="col">
                                        <?= $form->field($model, 'nama_rs')->textInput()->label('Nama Rumah Sakit') ?>
                                    </div>
                                    
                                    
                                </div>

                                <div class="row">

                                    <div class="col">
                                        <?= 
                                            $form->field($model, 'jenis_rs')->widget(Select2::classname(), [
                                                'data' => $jenisRumahSakit,                        
                                                'options' => ['placeholder' => 'Pilih Jenis Rumah Sakit ...'],
                                                'pluginOptions' => [
                                                    // 'allowClear' => true
                                                    // 'allowClear' => true //menghilang tanda silang ketika choose
                                                ],
                                            ])->label('Jenis Rumah Sakit'); 
                                        ?>
                                    </div>

                                    <div class="col">
                                        <?= 
                                            $form->field($model, 'kelas_rs')->widget(Select2::classname(), [
                                                'data' => $kelasRumahSakit,                        
                                                'options' => ['placeholder' => 'Pilih Kelas Rumah Sakit ...'],
                                                'pluginOptions' => [
                                                    // 'allowClear' => true
                                                    // 'allowClear' => true //menghilang tanda silang ketika choose
                                                ],
                                            ])->label('Kelas Rumah Sakit'); 
                                        ?>
                                    </div>
                                    <div class="col">
                                        <?= $form->field($model, 'nama_direktur_rs')->textInput()->label('Nama Direktur Rumah Sakit') ?>
                                    </div>
                                
                                </div>

                                <div class="row mt-4">
                                    <div class="col">
                                        <?= $form->field($model, 'alamat_rs')->textArea(['maxlength' => true])->label('Alamat Rumah Sakit') ?>
                                    </div>
                                    <div class="col">
                                        <!-- <?= $form->field($model, 'kab_kota_rs')->textInput()->label('Kab/Kota Rumah Sakit') ?> -->
                                        <?= 
                                            $form->field($model, 'kab_kota_rs')->widget(Select2::classname(), [
                                                'data' => $kabupaten,                        
                                                'options' => ['placeholder' => 'Pilih Kab/kota ...'],
                                                'pluginOptions' => [
                                                    // 'allowClear' => true
                                                    // 'allowClear' => true //menghilang tanda silang ketika choose
                                                ],
                                            ])->label('Kab/Kota Rumah Sakit'); 
                                        ?>
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'kode_pos_rs')->textInput() ?>
                                    </div>
                                    
                                </div>

                                <div class="row mt-4">
                                    <div class="col">

                                        <?= $form->field($model, 'telepon_rs')->textInput() ?>
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'fax_rs')->textInput() ?>
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'email_rs')->textInput() ?>
                                    </div>

                                    <div class="col">

                                        <?= $form->field($model, 'nomor_telepon_bag_umum_rs')->textInput()->label('Nomor Telepon Bagian Umum RS') ?>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    
                                    <div class="col">

                                        <?= $form->field($model, 'website_rs')->textInput()->label('Website RS') ?>
                                    </div>
                                    <div class="col">
                                        
                                        <?= $form->field($model, 'luas_tanah_rs')->textInput()->label('Luas Tanah RS') ?>
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'luas_bangunan_rs')->textInput()->label('Luas Bangunan Rumah Sakit') ?>
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'nomor_surat_izin_rs')->textInput()->label('Nomor Surat izin Rumah Sakit') ?>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col">
                                        <?= 
                                            $form->field($model, 'tanggal_surat_izin_rs')->widget(DatePicker::classname(), [
                                                'options' => ['placeholder' => 'Tanggal Surat Izin ...'],
                                                'pluginOptions' => [
                                                    'autoclose' => true,
                                                    'format' => 'dd-M-yyyy'
                                                ],
                                            ])->label('Tanggal Surat izin Rumah Sakit'); 
                                        ?> 
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'surat_izin_rs_dikeluarkan_oleh')->textInput()->label('Surat Izin Dikeluarkan Oleh') ?>
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'sifat_surat_izin_rs')->textInput()->label('Sifat Surat izin') ?>
                                    </div>

                                    <div class="col">

                                        <?= $form->field($model, 'masa_berlaku_surat_izin_rs')->textInput()->label('Masa Berlaku Surat Izin') ?>
                                    </div>
                                </div>

                                <div class="row">
                                
                                    <div class="col">

                                        <?= 
                                            $form->field($model, 'status_penyelenggara_swasta_rs')->widget(Select2::classname(), [
                                                'data' => $statusPenyelenggaraSosial,                        
                                                'options' => ['placeholder' => 'Pilih Penyelenggara Sosial ...'],
                                                'pluginOptions' => [
                                                    // 'allowClear' => true
                                                    // 'allowClear' => true //menghilang tanda silang ketika choose
                                                ],
                                            ])->label('Status Penyelenggara Sosial'); 
                                        ?>
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'akreditasi_rs')->textInput()->label('Akreditasi RS') ?>
                                    </div>
                                    <div class="col">

                                        <?= $form->field($model, 'pentahapan_akreditasi_rs')->textInput()->label('Pentahapan Akreditasi RS') ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">

                                        <?= $form->field($model, 'status_akreditasi_rs')->textInput()->label('Status Akreditasi RS') ?>
                                    </div>
                                    <div class="col">
                                         <?= 
                                            $form->field($model, 'tanggal_akreditasi_rs')->widget(DatePicker::classname(), [
                                                'options' => ['placeholder' => 'Tanggal Akreditasi RS ...'],
                                                'pluginOptions' => [
                                                    'autoclose' => true,
                                                    'format' => 'dd-M-yyyy'
                                                ],
                                            ])->label('Tanggal Akreditasi Rumah Sakit'); 
                                        ?> 
                                    </div>
                                </div>


                                <!-- <?= $form->field($model, 'created_at')->textInput() ?>

                                <?= $form->field($model, 'updated_at')->textInput() ?>

                                <?= $form->field($model, 'updated_by')->textInput() ?>

                                <?= $form->field($model, 'is_deleted')->textInput() ?> -->

                                <div class="form-group float-sm-right">
                                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>                                
                                </div>

                            <?php ActiveForm::end(); ?>
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>
    </section>      

</div>

