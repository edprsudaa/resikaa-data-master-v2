<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTarifTindakan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="medis-tarif-tindakan-form">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">Tambah Tarif Tindakan</div>
                </div>
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['medis-tindakan/save-tarif-tindakan'],
                ]); ?>

               
                    <div class="card-body">
                        <input type="hidden" name="idTindakan" value="<?=$dataMedisTindakan->id?>">
                      
                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="skTarif">SK Tarif</label>
                                    <?php
                                        echo Select2::widget([
                                            'name' => 'idSkTarif',
                                            'data' =>$skTarifTindakan,
                                            'options' => ['placeholder' => 'Pilih ...', 'autocomplete' => 'off','class'=>'form-control-sm'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                    ?>
                                </div>
                              
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kelasRawat">Kelas Rawat</label>
                                    <?php
                                        echo Select2::widget([
                                            'name' => 'kelasRawatKode',
                                            'data' =>$kelasRawat,
                                            'options' => ['placeholder' => 'Pilih ...', 'autocomplete' => 'off','class'=>'form-control-sm'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                    ?>
                                </div>
                            </div>                        
                        </div>                        

                        <div class="row ">
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Administrasi</label>
                                    <input type="number" name="js_adm" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                 <div class="form-group">
                                    <label>Jasa Sarana</label>
                                    <input type="number" name="js_sarana" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa BHP</label>
                                    <input type="number" name="js_bhp" class="form-control">
                                </div>
                            </div>
                            
                        </div>

                        <div class="row ">

                            <div class="col">
                                 <div class="form-group">
                                    <label>Jasa Dokter Operator</label>
                                    <input type="number" name="js_dokter_operator" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Dokter Lainnya</label>
                                    <input type="number" name="js_dokter_lainnya" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col">
                                 <div class="form-group">
                                    <label>Jasa Dokter Anastesi</label>
                                    <input type="number" name="js_dokter_anastesi" class="form-control">
                                </div>                                
                            </div>
                            
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Penata Anastesi</label>
                                    <input type="number" name="js_penata_anastesi" class="form-control">
                                </div>   
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Paramedis</label>
                                    <input type="number" name="js_paramedis" class="form-control">
                                </div> 
                            </div>
                            <div class="col">
                                 <div class="form-group">
                                    <label>Jasa Lainnya</label>
                                    <input type="number" name="js_lainya" class="form-control">
                                </div> 
                            </div>
                        </div>

                        <!-- <input type='text' class="form-control" id='JumlahJsNonCTO' readonly> -->

                        <div class="row mt-4">
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Administrasi CTO</label>
                                    <input type="number" name="js_adm_cto" class="form-control">
                                </div> 
                            </div>
                            <div class="col">
                                 <div class="form-group">
                                    <label>Jasa Sarana CTO</label>
                                    <input type="number" name="js_sarana_cto" class="form-control">
                                </div> 
                            </div>
                            <div class="col">
                                 <div class="form-group">
                                    <label>Jasa BHP CTO</label>
                                    <input type="number" name="js_bhp_cto" class="form-control">
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Dokter Operator CTO</label>
                                    <input type="number" name="js_dokter_operator_cto" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Dokter Lainnya CTO</label>
                                    <input type="number" name="js_dokter_lainya_cto" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Dokter Anastesi CTO</label>
                                    <input type="number" name="js_dokter_anastesi_cto" class="form-control">
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col">
                                 <div class="form-group">
                                    <label>Jasa Penata Anastesi CTO</label>
                                    <input type="number" name="js_penata_anastesi_cto" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Jasa Paramedis CTO</label>
                                    <input type="number" name="js_paramedis_cto" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                 <div class="form-group">
                                    <label>Jasa Lainnya CTO</label>
                                    <input type="number" name="js_lainya_cto" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                         <!-- <input type='text' class="form-control" id='JumlahJsCTO' readonly> -->
                       
                    </div>    
                    <div class="card-footer">
                        <div class="form-group float-sm-right">
                            <?= Html::a('Kembali', ['add-tarif-tindakan','id'=>$dataMedisTindakan->id], ['class' => 'btn btn-warning']) ?>
                            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                        </div>                           
                    </div>           
                <?php ActiveForm::end(); ?>               
            
            </div>
        </div>
    </div>
</div>

