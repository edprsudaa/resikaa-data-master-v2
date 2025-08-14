<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\Aplikasi;
use app\models\AkunAknUser;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\HelperSso;
use app\models\PegawaiUnitPenempatan;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AksesUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akses Unit Pengguna';
$this->params['breadcrumbs'][] = $this->title;
$aplikasi = Aplikasi::find()->orderBy(['nma'=> SORT_ASC])->all();
$dataPengguna = AkunAknUser::find()->all();
$unit = PegawaiUnitPenempatan::find()->where(['aktif'=> 1])->orderBy(['nama'=> SORT_ASC])->all();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Akses Unit Pengguna</h5>
                </div>
                <div class="card-body">
                        

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                    <hr>                                              

                    <?php Pjax::begin(['id'=>'akses-unit']); ?>
                        <div class="table-responsive">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    [
                                        'attribute' => 'id',
                                        'headerOptions' => ['style' => 'width:100px'],
                                    ],
                                    [
                                        'attribute' => 'pengguna_id',
                                        'value' => 'pengguna.pegawai.nama_lengkap',                                                 
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'pengguna_id',
                                            'data' => ArrayHelper::map($dataPengguna, 'userid', 'nama'),
                                            'options' => [
                                                'placeholder' => 'Pilih Berdasarkan Nama Pengguna...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute' => 'unit_id',
                                        'value' => 'unitPenempatan.nama',
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'unit_id',
                                            'data' =>  ArrayHelper::map($unit,'kode','nama'),
                                            'options' => [
                                                'placeholder' => 'Pilih Berdasarkan Nama Unit...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),

                                    ],
                                    [
                                        'attribute' => 'id_aplikasi',
                                        'value' => 'aplikasi.nma',
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'id_aplikasi',
                                            'data' => ArrayHelper::map($aplikasi, 'id', 'nma'),
                                            'options' => [
                                                'placeholder' => 'Pilih Berdasarkan Nama Aplikasi...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],

                                    [
                                        'attribute'=>'aktif',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                            return $status[$model->aktif];
                                        },
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'aktif',
                                            'data' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],

                                    [
                                        'headerOptions' => ['style' => 'min-width: 120px;'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'contentOptions' => ['style' => 'text-align: center;'],
                                        'header' => 'Aksi',
                                        'template' => '{view}{update}',
                                        // 'template' => '{view}{update}{delete}',
                                        'buttons' => [                        
                                            
                                            'view' => function($id, $model) {
                    
                                                return Html::a('<span class="btn btn-sm btn-warning mr-2"><b class="fas fa-eye"></b></span>', null,
                                                [
                                                    'title' => 'Detail',
                                                    'data' => [
                                                        'toggle'    => 'modal',
                                                        'target'    => '#viewModal',
                                                        'id'        => $model->id,  
                                                    ],
                                                ]);
                                            },

                                            'update' => function($id, $model) {
                                
                                                return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                [
                                                    'title' => 'Ubah',
                                                    'data' => [
                                                        'toggle'    => 'modal',
                                                        'target'    => '#editModal',
                                                        'id'        => $model->id, 
                                                        'unit_id'=> $model->unit_id,
                                                        'pengguna_id'  => $model->pengguna_id,
                                                        'id_aplikasi'      => $model->id_aplikasi,
                                                        'aktif'      => $model->aktif,
                                                    ],
                                                ]);
                                            },

                                            // 'delete' => function ($id, $model) {
                                            //     return Html::button('<b class="fa fa-trash"></b>', [
                                            //         'class' => 'btn btn-sm btn-danger',
                                            //         'data'  => [
                                            //             'toggle'    => 'modal',
                                            //             'target'    => '#delete-modal',
                                            //             'id'        => $model->id
                                            //         ],
                                            //     ]);
                                            // },
                                    
                                        ]
                                    ],
                                ],
                                'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                                'pager' => [
                                    'class' => 'yii\bootstrap4\LinkPager',
                                ]
                            ]); ?>

                        </div>
                    <?php Pjax::end(); ?>
                       
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Unit</th>
                            <td id="unit-detail"></td>
                        </tr>
                        <tr>
                            <th>Nama Pegawai <br> NIP/NIK</th>
                            <td id="pegawai-detail"></td>
                        </tr>
                        <tr>
                            <th>Status Akses</th>
                            <td id="status-detail"></td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada <br> User Id</th>
                            <td id="dibuat-pada-detail"></td>
                        </tr>
                        
                        <tr>
                            <th>Diubah Pada <br> User Id</th>
                            <td id="diubah-pada-detail"></td>
                        </tr>
                       
                         <tr id="column-tanggal-nonaktif" style="display:none">
                            <th>Tanggal Non Aktif</th>
                            <td id="tanggalNonAktif"></td>
                        </tr>
                      
                    </thead>
                </table>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Akses Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-akses-unit-edit',
                            'options' => [
                                'data-pjax' => true,
                            ]
                        ]); 

                        // $dataPegawai = HelperSso::getDataPegawai();
                        $dataPengguna = AkunAknUser::find()->all();
                        $unit = PegawaiUnitPenempatan::find()->where(['aktif'=> 1])->orderBy(['nama'=> SORT_ASC])->all();
                        $aplikasi = Aplikasi::find()->orderBy(['nma'=> SORT_ASC])->all();
                        
                        ?>

                        <input type="hidden" id="id">
                        <?= $form->field($model, 'pengguna_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map($dataPengguna, 'userid', 'nama'),
                            'options' => [
                                'id'=>'pengguna_id_edit',
                                'disabled' => true
                            ],
                            
                        ]);
                        ?>

                        <?= $form->field($model, 'unit_id')->widget(Select2::classname(), [
                            'data' =>  ArrayHelper::map($unit,'kode','nama'),
                            'options' => ['placeholder' => 'Pilih Unit...','id'=>'unit_id_edit'],
                            'pluginOptions' => [
                            'allowClear' => false
                            ],
                        ]);
                        ?>

                        <?= $form->field($model, 'id_aplikasi')->widget(Select2::classname(), [
                            'data' =>  ArrayHelper::map($aplikasi,'id','nma'),
                            'options' => ['placeholder' => 'Pilih Aplikasi...', 'id'=>'id_aplikasi_edit'],
                            'pluginOptions' => [
                            'allowClear' => false
                            ],
                        ]);
                        ?>

                        <?= 
                        $form->field($model, 'aktif')->widget(Select2::classname(), [
                            'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                            'options' => [
                                'placeholder' => 'Pilih...',
                                'id'    =>'aktif'
                            ],
                            ]); 
                        ?>

                        <div class="col-lg-2">
                            <div class="box-footer">
                                <label for="" style="color:white">s</label>
                                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success btn-block btn-flat', 'id'=>'btnEdit']) ?>
                            </div>
                        </div>
                          
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idAksesUnit">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>              
                <button type="submit" id="btnDelete" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#viewModal").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data("id");
       
        $.ajax({
            url: '<?php echo Url::to(['akses-unit/view']) ?>' + '?id=' + id,
            type: "POST",
            data: {id: id},
            success: function(response) {
                console.log('response : ', response);
                $('#unit-detail').html(response.data.unitPenempatan.nama);
                $('#pegawai-detail').html(response.data.pengguna.dataPegawai.nama_lengkap + '<br>' + response.data.pengguna.dataPegawai.id_nip_nrp );
                $('#status-detail').html(response.data.aktif == 0 ? '<div class="badge badge-sm badge-danger">Tidak AKtif</div>':'<div class="badge badge-sm badge-success">AKtif</div>');
                $('#dibuat-pada-detail').html(response.data.created_at + '<br>' + response.data.created_by );
                $('#diubah-pada-detail').html(response.data.updated_at == null ? '-' : response.data.updated_at + '<br>' + response.data.updated_by );            
                 if(response.data.tanggal_nonaktif == null){
                    $('#tanggalNonAktif').html('-');
                    $("#column-tanggal-nonaktif").css({ display: "none" });
                }else{
                    $('#tanggalNonAktif').html(response.data.tanggal_nonaktif);
                    $('#column-tanggal-nonaktif').removeAttr("style");

                }  
                            
            }
        });
    });

    $(document).on("beforeSubmit", "form#form-akses-unit", function (e) {

        var form = $(this);
        var formData = form.serialize();       

            $.ajax({
                url: '<?php echo Url::to(['akses-unit/create']) ?>',
                type: 'post',
                data: formData,
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.status === 200) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            // timer   : 3000  
                        });                      

                    }else{
                        swal.fire({
                            title   :  response.message ,
                            html: 'Pesan : ' + '<pre>' + JSON.stringify(response.data, null, 4) + '</pre>',
                            icon    : "error",
                            allowOutsideClick: false
                        });                   
                    }            
                    
                },
                error: function(xhr, status, error) {
                    // handle error response here
                    var errorMessage = xhr.responseText;
                    console.log(errorMessage); // log error message to console for debugging
                }
            });
        
    });

    $('#editModal').on('show.bs.modal',function(e){
         
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        var unit_id = button.data('unit_id'); 
        var pengguna_id = button.data('pengguna_id'); 
        var id_aplikasi = button.data('id_aplikasi'); 
        var aktif = button.data('aktif'); 

        $('#id').val(id);
        $('#unit_id_edit').val(unit_id).trigger('change');
        $('#pengguna_id_edit').val(pengguna_id).trigger('change');
        $('#id_aplikasi_edit').val(id_aplikasi).trigger('change');
        $('#aktif').val(aktif).trigger('change');
    });

    $('#btnEdit').click(function(e) {

        e.preventDefault();

        var id       = $('#id').val();
        var unit_id     = $('#unit_id_edit').val();
        var pengguna_id    = $('#pengguna_id_edit').val();
        var id_aplikasi  = $('#id_aplikasi_edit').val();
        var aktif  = $('#aktif').val();

        $.ajax({
            url: '<?php echo Url::to(['akses-unit/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                unit_id : unit_id,
                pengguna_id: pengguna_id,
                id_aplikasi : id_aplikasi,
                aktif : aktif,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                    });
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#akses-unit',{timeout:3000});   

                }
                else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                    });
                }
                
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
      
       
    });

    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#idAksesUnit').val(id);        
    });

    $('#btnDelete').click(function(e) {
        e.preventDefault();

        var id  = $('#idAksesUnit').val();

        $.ajax({
            url: '<?php echo Url::to(['akses-unit/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success"
                    });
                    $('#delete-modal').modal('hide'); 
                    $.pjax.reload('#akses-unit', {timeout:3000});     

                }else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                        // timer   : 3000
                    });
                }
                
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus data.');
            }
        });

    }); 
</script>

