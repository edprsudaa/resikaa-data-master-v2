<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;

use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use app\models\MedisTarifTindakan;

// $this->title = 'Tarif Tindakan';

$this->params['breadcrumbs'][] = ['label' => 'Medis Tindakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Tarif Tindakan';
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12"> 

           
            <div class="card card-primary">

                <div class="card-header">
                    <div class="card-title">Tarif Tindakan</div>
                </div>

                <div class="card-body">

                <div class="mb-2 form-group">
                    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning mr-2']) ?>
                    <a href=""></a>
                                       
                    <?=
                        Html::a('<span class="btn btn-success mr-2">+ Tambah Tarif Tindakan</span>', null,
                            [
                                'data' => [
                                    'toggle'    => 'modal',
                                    'target'    => '#addTarifTindakanModal',
                                    'id'        =>  $medisTindakan->id 
                                ],
                            ]);
                    ?>
                  
                </div>             
                   
                    <div class="invoice p-3 mb-3">
                        
                                               
                        <div class="row invoice-info ">                       
                            
                            <div class="col invoice-col ">
                                <address>
                                    <strong>Referensi</strong><br>
                                    <?= $dataMedisTindakan->deskripsi?>
                                </address>                           
                            </div>

                            <div class="col invoice-col">
                                <address>
                                    <strong> Kode Jenis</strong><br>
                                    <?= $medisTindakan->kode_jenis?>
                                </address>
                            </div>
                            <div class="col invoice-col ">                           
                            <address>
                                <strong>Tindakan</strong><br>
                                <?= $medisTindakan->deskripsi?>
                            </address>
                        </div>
                    </div>

                    <div class="row">                  
                        <div class="col-12 table-responsive">
                        <?php Pjax::begin(['id' => 'pjax-tarif-tindakan']); ?>
                        
                            <?= GridView::widget([
                                'dataProvider' => $dataProviderTarifTindakan,
                                'filterModel' => $searchModelTarifTindakan,
                                'options' => [
                                    'id' => 'my-gridview-tindakan'
                                ],
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    [
                                        // 'headerOptions'=>['style'=>'min-width:320px'],    
                                        'attribute' => 'kelas_rawat_kode',
                                        'label'     => 'Kelas Rawat',
                                        'headerOptions' => ['style'=>'width:300px'],
                                        'value'     => 'kelasrawat.nama',
                                        'filter' => Select2::widget([
                                            'model' => $searchModelTarifTindakan,
                                            'attribute' => 'kelas_rawat_kode',
                                            'data' => $kelasRawat,
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                   
                                    [
                                        'attribute' => 'sk_tarif_id',
                                        'value'     => 'sktarif.nomor',
                                        'filter' => false,
                                    ],

                                    [                                 
                                        'headerOptions'=>['style'=>'width:150px'],
                                        'contentOptions' => ['class'=>'text-center'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'header'=>'Hapus',
                                        'template' => '{delete}{import}{tarif}',
                                        'buttons' => [

                                             'delete' => function($url, $model) {
                                                return Html::a('<span class="btn btn-sm btn-danger mr-1"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Delete', 'class' => '', 'data' => ['toggle'=>'modal',
                                                'target'=>'#deleteModal',
                                                'id' => $model->id,],]);
                                            },                                           

                                        ]
                                    ],
                                    [                                 
                                        // 'headerOptions'=>['style'=>'min-width:210px'],
                                        'headerOptions'=>['style'=>'width:150px'],
                                        'contentOptions' => ['class'=>'text-center'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'header'=>'Tarif',
                                        'template' => '{import}{tarif}',
                                        'buttons' => [

                                            'tarif' => function ($url, $model) {
                                                $icon='<span class="btn btn-sm btn-warning"><b class="fa fa-credit-card"></b></span>';
                                                return Html::a($icon,$url,[
                                                    'data-toggle'=>"modal",
                                                    'data-target'=>"#tarifModal",
                                                    'data-backdrop'=>"static",
                                                    'data-keyboard'=>"false",
                                                    'data-id' => $model->id,
                                                    'data-pjax' => '0',
                                                ]);
                                            },                                            

                                        ]
                                    ],
                                ],
                                'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                                'pager' => [
                                    'class' => 'yii\bootstrap4\LinkPager',
                                ],
                                'layout' => "{summary}\n<div class='table-responsive' style='overflow-x: auto;'>{items}</div>\n{pager}",
                            ]);
                            ?>
                        <?php Pjax::end(); ?>                            
                        </div>
                    </div>             

                    
                </div>
            </div>
        </div>
    </div>
</div>


<!-- tambah Modal -->
<div class="modal fade" id="addTarifTindakanModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Form Tambah Tarif Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-add-tarif-tindakan']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                         <div class="card-body">
                            <input type="hidden" name="idTindakan" id="idTindakan">
                        
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="skTarif">SK Tarif</label>
                                        <?php
                                            echo Select2::widget([
                                                'name'  => 'sk_tarif_id',
                                                'data'  => $skTarifTindakan,
                                                'options' => [
                                                    'placeholder'   => 'Pilih ...', 
                                                    'autocomplete'  => 'off',
                                                    'class'         => 'form-control-sm',
                                                    'required'      => true,
                                                    'id'            => 'skTarif'
                                                ],
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
                                                'attribute' => 'kelasRawatKode',
                                                'data' =>$kelasRawat,
                                                'options' => [
                                                    'placeholder'   => 'Pilih ...', 
                                                    'autocomplete'  => 'off',
                                                    'required'      => true,
                                                    'id'            => 'kelasRawat',
                                                    'multiple' => true,
                                                ],
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
                                        <input type="number" name="js_adm" class="form-control" id="js_adm">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Sarana</label>
                                        <input type="number" name="js_sarana" class="form-control" id="js_sarana">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa BHP</label>
                                        <input type="number" name="js_bhp" class="form-control" id="js_bhp">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row ">

                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Dokter Operator</label>
                                        <input type="number" name="js_dokter_operator" class="form-control" id="js_dokter_operator">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Dokter Lainnya</label>
                                        <input type="number" name="js_dokter_lainnya" class="form-control" id="js_dokter_lainnya">
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Dokter Anastesi</label>
                                        <input type="number" name="js_dokter_anastesi" class="form-control" id="js_dokter_anastesi">
                                    </div>                                
                                </div>
                                
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Penata Anastesi</label>
                                        <input type="number" name="js_penata_anastesi" class="form-control" id="js_penata_anastesi">
                                    </div>   
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Paramedis</label>
                                        <input type="number" name="js_paramedis" class="form-control" id="js_paramedis">
                                    </div> 
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Lainnya</label>
                                        <input type="number" name="js_lainya" class="form-control" id="js_lainya">
                                    </div> 
                                </div>
                            </div>

                            <!-- <input type='text' class="form-control" id='JumlahJsNonCTO' readonly> -->

                            <div class="row mt-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Administrasi CTO</label>
                                        <input type="number" name="js_adm_cto" class="form-control" id="js_adm_cto">
                                    </div> 
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Sarana CTO</label>
                                        <input type="number" name="js_sarana_cto" class="form-control" id="js_sarana_cto">
                                    </div> 
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa BHP CTO</label>
                                        <input type="number" name="js_bhp_cto" class="form-control" id="js_bhp_cto">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Dokter Operator CTO</label>
                                        <input type="number" name="js_dokter_operator_cto" class="form-control" id="js_dokter_operator_cto">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Dokter Lainnya CTO</label>
                                        <input type="number" name="js_dokter_lainya_cto" class="form-control" id="js_dokter_lainya_cto">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Dokter Anastesi CTO</label>
                                        <input type="number" name="js_dokter_anastesi_cto" class="form-control" id="js_dokter_anastesi_cto">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Penata Anastesi CTO</label>
                                        <input type="number" name="js_penata_anastesi_cto" class="form-control" id="js_penata_anastesi_cto">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Paramedis CTO</label>
                                        <input type="number" name="js_paramedis_cto" class="form-control" id="js_paramedis_cto">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jasa Lainnya CTO</label>
                                        <input type="number" name="js_lainya_cto" class="form-control" id="js_lainya_cto">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <input type='text' class="form-control" id='JumlahJsCTO' readonly> -->
                        
                        </div>  
                    </div>  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnAddTarifTindakan" class="btn btn-primary" autocomplete="off">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- tarif view/update Modal -->
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
                <input type="hidden" name="idTarif" id="idTarif">
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="skTarif">SK Tarif</label>
                            <?php
                                $selectedSkTarif = '';

                                echo Select2::widget([
                                    'name' => 'idSkTarif',
                                    'value' =>  $selectedSkTarif,
                                    'data' =>$skTarifTindakan,
                                    'options' => ['id' => 'sk-tarif-select','placeholder' => 'Pilih ...', 'autocomplete' => 'off','class'=>'form-control-sm'],
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

                                $selectedKelasRawat = '';

                                echo Select2::widget([
                                    'name' => 'kelasRawatKode',
                                    'value'=> $selectedKelasRawat,
                                    'data' =>$kelasRawat,
                                    'options' => ['id' => 'kelas-rawat-select','placeholder' => 'Pilih ...', 'autocomplete' => 'off','class'=>'form-control-sm'],
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
                                <input type="number"  class="form-control" name="js_bhp" id="jsBHP">
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
                    <button type="submit" id="update" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="modal-title">Hapus Tarif Tindakan</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['medis-tindakan/delete-tarif-tindakan'],
                // 'options' => ['id' => 'form-delete']
                ]);
            ?>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="hidden" id="id" name="id">
                        <p>Anda akan menghapus data berikut?</p>
                    </div>
                    
                </div>

               
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="update" class="btn btn-danger" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>



<?php 
$this->registerJs('
    $("#deleteModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var id = button.data("id");
        var modal = $(this);
        modal.find("#id").val(id);
    });
');
?>


<script type="text/javascript">    
    $('#tarifModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')

        $.ajax({
            type: "get",
            url: '<?php echo Url::to(['/medis-tarif-tindakan/get-tarif-tindakan/']) ?>' + '?id=' + id,
            
            success: function (data) {
                console.log('as: ',data);

                $selectedKelasRawat = data.kelas_rawat_kode;
                $selectedSkTarif = data.sk_tarif_id;

                $('#kelas-rawat-select').val($selectedKelasRawat).trigger('change');
                $('#sk-tarif-select').val($selectedSkTarif).trigger('change');
            

                $('#idTarif').val(data.id)
                $('#jsAdministrasi').val(parseInt(data.js_adm))
                $('#jsSarana').val(parseInt(data.js_sarana))
                $('#jsBHP').val(parseInt(data.js_bhp))
                $('#jsDokterOperator').val(parseInt(data.js_dokter_operator))
                $('#jsDokterLainnya').val(parseInt(data.js_dokter_lainya))
                $('#jsDokterAnastesi').val(parseInt(data.js_dokter_anastesi))
                $('#jsPenataAnastesi').val(parseInt(data.js_penata_anastesi))
                $('#jsParamedis').val(parseInt(data.js_paramedis))
                $('#jsLainnya').val(parseInt(data.js_lainya))

                $('#jsAdministrasiCto').val(parseInt(data.js_adm_cto))
                $('#jsSaranaCto').val(parseInt(data.js_sarana_cto))
                $('#jsBHPCto').val(parseInt(data.js_bhp_cto))
                $('#jsDokterOperatorCto').val(parseInt(data.js_dokter_operator_cto))
                $('#jsDokterLainnyaCto').val(parseInt(data.js_dokter_lainya_cto))
                $('#jsDokterAnastesiCto').val(parseInt(data.js_dokter_anastesi_cto))
                $('#jsPenataAnastesiCto').val(parseInt(data.js_penata_anastesi_cto))
                $('#jsParamedisCto').val(parseInt(data.js_paramedis_cto))
                $('#jsLainnyaCto').val(parseInt(data.js_lainya_cto))
            
            },
            error: function (exception) {
                alert('Something Wrong!!, Failed to Get Data..');
            }
        })

    });

    $(document).on('click', '[data-toggle="modal"][data-target="#addTarifTindakanModal"]', function(){
        var id = $(this).data('id');
        $('#idTindakan').val(id);
    });

    $('#btnAddTarifTindakan').click(function(e) {
        e.preventDefault();

        var idTindakan          = $('#idTindakan').val();
        var kelas               = $('#kelasRawat').val();
        var skTarif             = $('#skTarif').val();

        console.log('kelas : ', kelas);

        var jsAdministrasi      = $('#js_adm').val();
        var jsSarana            = $('#js_sarana').val();
        var jsBHP               = $('#js_bhp').val();
        var jsDokterOperator    = $('#js_dokter_operator').val();
        var jsDokterLainnya     = $('#js_dokter_lainnya').val();
        var jsDokterAnastesi    = $('#js_dokter_anastesi').val();
        var jsPenataAnastesi    = $('#js_penata_anastesi').val();
        var jsParamedis         = $('#js_paramedis').val();
        var jsLainnya           = $('#js_lainya').val();
        
        
        var jsAdministrasiCto   = $('#js_adm_cto').val();
        var jsSaranaCto         = $('#js_sarana_cto').val();
        var jsBHPCto            = $('#js_bhp_cto').val();
        var jsDokterOperatorCto = $('#js_dokter_operator_cto').val();
        var jsDokterLainnyaCto  = $('#js_dokter_lainnya_cto').val();
        var jsDokterAnastesiCto = $('#js_dokter_anastesi_cto').val();
        var jsPenataAnastesiCto = $('#js_penata_anastesi_cto').val();
        var jsParamedisCto      = $('#js_paramedis_cto').val();
        var jsLainnyaCto        = $('#js_lainya_cto').val();   
        
        var form = $('#form-add-tarif-tindakan');
       
        $.ajax({
            url: '<?php echo Url::to(['medis-tindakan/create']) ?>',
            type: 'post',          
            data: {
                idTindakan          : idTindakan,
                skTarif             : skTarif,
                kelas               : kelas,
                jsAdministrasi      : jsAdministrasi,
                jsSarana            : jsSarana,
                jsBHP               : jsBHP,
                jsDokterOperator    : jsDokterOperator,
                jsDokterLainnya     : jsDokterLainnya,
                jsDokterAnastesi    : jsDokterAnastesi,
                jsPenataAnastesi    : jsPenataAnastesi,
                jsParamedis         : jsParamedis,
                jsLainnya           : jsLainnya,
                jsAdministrasiCto   : jsAdministrasiCto,
                jsSaranaCto         : jsSaranaCto,
                jsBHPCto            : jsBHPCto,
                jsDokterOperatorCto : jsDokterOperatorCto,
                jsDokterLainnyaCto  : jsDokterLainnyaCto,
                jsDokterAnastesiCto : jsDokterAnastesiCto,
                jsPenataAnastesiCto : jsPenataAnastesiCto,
                jsParamedisCto      : jsParamedisCto,
                jsLainnyaCto        : jsLainnyaCto,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.length > 0) {
                    // If response is an array, loop through it
                    $.each(response, function(key, value) {
                        if (value.success == true) {
                            swal.fire({
                                title   : value.message,
                                icon    : "success",
                                timer   : 3000  
                            });
                            // document.getElementById("form-add-tarif-tindakan").reset();
                            form.trigger('reset');
                            $('#skTarif').val(null).trigger('change');
                            $('#addTarifTindakanModal').modal('hide');                                 
                            $.pjax.reload('#pjax-tarif-tindakan #my-gridview-tindakan', {timeout: 3000});
                        } else {
                            // Handle error response
                           swal.fire({
                            title   : value.message,
                            icon    : "error",
                            timer   : 3000
                        });
                        }
                    });
                } else {
                    // Handle empty response
                    console.log('No response received.');
                }           
                
            },
            error: function() {
                 console.log('Terjadi kesalahan saat menyimpan data.');
            }
        });
        
       
    });

</script>
