<div class="modal fade" id="tarifModal" tabindex="-1" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Tarif Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['medis-tindakan/update-tarif-tindakan']                
            ]);
            ?> 

            
            <div class="modal-body">

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
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="idTindakan" id="idTindakan">
                        <div class="form-group row">
                            <label for="jsAdministrasi" class="col-sm-4 col-form-label">Jasa Administrasi</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" name="js_adm" id="jsAdministrasi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsSarana" class="col-sm-4 col-form-label">Jasa Sarana</label>
                            <div class="col-sm-8">

                                    <input type="text" name="js_sarana"  class="form-control" id="jsSarana">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsBHP" class="col-sm-4 col-form-label">Jasa BHP</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" name="js_bhp" id="jsBHP">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsDokterOperator"  class="col-sm-4 col-form-label">Jasa Dokter Operator</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_dokter_operator"  class="form-control" id="jsDokterOperator">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsDokterLainnya" class="col-sm-4 col-form-label">Jasa Dokter Lainnya</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_dokter_lainnya"  class="form-control" id="jsDokterLainnya">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsDokterAnastesi" class="col-sm-4 col-form-label">Jasa Dokter Anastesi</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_dokter_anastesi"  class="form-control" id="jsDokterAnastesi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsPenataAnastesi" class="col-sm-4 col-form-label">Jasa Penata Anastesi</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_penata_anastesi" class="form-control" id="jsPenataAnastesi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsParamedis" class="col-sm-4 col-form-label">Jasa Paramedis</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_paramedis" class="form-control" id="jsParamedis">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsLainnya" class="col-sm-4 col-form-label">Jasa Lainnya</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" name="js_lainya" id="jsLainnya">
                            </div>
                        </div>
                       
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="jsAdministrasiCto" class="col-sm-4 col-form-label">Jasa Administrasi CTO</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" name="js_adm_cto" id="jsAdministrasiCto">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="jsSaranaCto" class="col-sm-4 col-form-label">Jasa Sarana CTO</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" name="js_sarana_cto" id="jsSaranaCto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsBHPCto" class="col-sm-4 col-form-label">Jasa BHP CTO</label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" name="js_bhp_cto" id="jsBHPCto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsDokterOperatorCto" class="col-sm-4 col-form-label">Jasa Dokter Operator CTO</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_dokter_operator_cto" class="form-control" id="jsDokterOperatorCto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsDokterLainnyaCto" class="col-sm-4 col-form-label">Jasa Dokter Lainnya CTO</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_dokter_lainya_cto"  class="form-control" id="jsDokterLainnyaCto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsDokterAnastesiCto" class="col-sm-4 col-form-label">Jasa Dokter Anastesi CTO</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_dokter_anastesi_cto"  class="form-control" id="jsDokterAnastesiCto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsPenataAnastesiCto" class="col-sm-4 col-form-label">Jasa Penata Anastesi CTO</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_penata_anastesi_cto" class="form-control" id="jsPenataAnastesiCto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsParamedisCto" class="col-sm-4 col-form-label">Jasa Paramedis CTO</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_paramedis_cto" class="form-control" id="jsParamedisCto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jsLainnyaCto" class="col-sm-4 col-form-label">Jasa Lainnya CTO</label>
                            <div class="col-sm-8">
                                <input type="text" name="js_lainya_cto" class="form-control" id="jsLainnyaCto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="update" class="btn btn-warning" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>