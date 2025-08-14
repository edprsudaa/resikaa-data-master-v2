<?php

use app\models\UNIT;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiPegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pegawai';
$this->params['breadcrumbs'][] = 'Data Pegawai';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header"><h5>Data Pegawai</h5>  </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <?php Pjax::begin(['id'=> 'pegawai-pjax']); ?>

                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            // ['class' => 'yii\grid\SerialColumn'],

                                            [
                                                // 'headerOptions' => ['style' => 'min-width: 120px'],
                                                'class' => 'yii\grid\ActionColumn',
                                                'template' => '{update}',
                                                'buttons' => [
                                                    
                                                    'update' => function($pegawai_id, $model) {
                
                                                        return Html::a('<span class="btn btn-sm btn-warning mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                        [
                                                            'title' => 'Ubah',
                                                            'data' => [
                                                                'toggle'    => 'modal',
                                                                'target'    => '#editModal',
                                                                'id'        => $model->pegawai_id, 
                                                            ],
                                                        ]);
                                                    },
                                                                                                
                                                ]
                                            ],

                                              [
                                                'headerOptions' => ['style' => 'max-width: 90px'],
                                                'attribute' => 'photo',
                                                'format' => 'raw',
                                                'filter' => false,
                                                // 'format' => 'html',
                                                'value' => function ($model) {
                                                    $baseUrl = 'http://123.231.247.213/rsud-app/web/file/profil/';
                                                    $profilePath = $baseUrl . $model->profile_path;

                                                    if ($model->profile_path) {
                                                        $image = Html::img($profilePath, ['alt' => 'photo pegawai', 'width' => '100px', 'height' => '100px']);
                                                        return Html::a($image, $profilePath, ['target' => '_blank']);
                                                    } else {
                                                        return '-';
                                                    }
                                                }
                                            ],

                                          
                                            // 'status_aktif_pegawai',

                                             [
                                                'headerOptions'=>['style'=>'min-width:150px'],
                                                'attribute' => 'status_aktif_pegawai',                                                
                                                'value'     => function ($model){
                                                    // $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                                    if ($model->status_aktif_pegawai==0) {
                                                       return  'Tidak Aktif';
                                                    } else {
                                                        return 'Aktif';
                                                    }
                                                    
                                                },

                                                 'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'status_aktif_pegawai',
                                                    'data' => [1 => 'Aktif', 0=> 'Tidak Aktif'],
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),


                                              
                                            ],

                                            //  'photo:ntext',

                                            [
                                                'headerOptions'=>['style'=>'min-width:90px'],
                                                'attribute' => 'pegawai_id',                                               

                                            ],
                                            [
                                                'headerOptions'=>['style'=>'min-width:120px'],
                                                'attribute' => 'id_nip_nrp',                                               

                                            ],


                                            [
                                                'attribute' => 'nama_lengkap',
                                                'headerOptions'=>['style'=>'min-width:200px'],
                                            ],
                                           
                                            [
                                                'attribute' => 'status_kepegawaian_id',
                                                'value'     => function ($model){
                                                    if ($model->statusKepegawaian) {
                                                       return $model->statusKepegawaian->status;
                                                    } else {
                                                        return null;
                                                    }
                                                    
                                                },
                                                'headerOptions'=>['style'=>'min-width:200px'],
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'status_kepegawaian_id',
                                                    'data' => ArrayHelper::map($statusKepegawaian, 'id','status'),
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),
                                            ],

                                            [
                                                'attribute' => 'jenis_kepegawaian_id',
                                                'value'     => function ($model){
                                                    if ($model->jenisKepegawaian) {
                                                        return $model->jenisKepegawaian->nama;
                                                    } else {
                                                        return '-';
                                                    }
                                                    // return $model->jenisKepegawaian->nama == null ? '-' : $model->jenisKepegawaian->nama ;
                                                },
                                                'headerOptions'=>['style'=>'min-width:200px'],
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'jenis_kepegawaian_id',
                                                    'data' => ArrayHelper::map($jenisKepegawaian, 'id','nama'),
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),
                                            ],

                                         
                                            [
                                                'headerOptions'=>['style'=>'min-width:180px'],
                                                'attribute'=>'tipe_user',
                                                'value' => function ($model){
                                                    $type = [1 => 'PNS', 2 => 'NON PNS', 3 => 'OUTSOURCING'];

                                                    if ($model->tipe_user) {
                                                        return $type[$model->tipe_user];
                                                    } else {
                                                        return null;
                                                    }
                                                   
                                                },
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'tipe_user',
                                                    'data' => [1 => 'PNS', 2 => 'NON PNS', 3 => 'OUTSOURCING'],
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),
                                            ],
                                            [
                                                'headerOptions'=>['style'=>'min-width:120px'],
                                                'attribute'=>'kode_dokter_maping_simrs',
                                            ],
                                          

                                            [
                                                // 'headerOptions'=>['style'=>'min-width:320px'],    
                                                'attribute' => 'userid',
                                                'label' => 'User ID',
                                               
                                                'value'     => function ($model){
                                                    if ($model->akunUser) {
                                                       return $model->akunUser->userId;
                                                    } else {
                                                        return null;
                                                    }
                                                    
                                                },
                                             
                                                   
                                            ],

                                            [
                                                'attribute' => 'status_user',
                                                'label' => 'Status Akun',
                                                'value'     => function ($model){
                                                    $status = [0 => 'Aktif', 1 => 'Tidak Aktif'];
                                                    if ($model->akunUser) {
                                                       return  $status[$model->akunUser->status];
                                                    } else {
                                                        return null;
                                                    }
                                                    
                                                },


                                              
                                            ],
                                            [
                                                'attribute' => 'role_user',
                                                'value'     => function ($model){
                                                    if ($model->akunUser) {
                                                       return  $model->akunUser->role;
                                                    } else {
                                                        return null;
                                                    }
                                                    
                                                },
                                            ],
                                           
                                           
                                            
                                        ],

                                        'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                                            'pager' => [
                                                'class' => 'yii\bootstrap4\LinkPager',
                                            ]
                                    ]); ?>

                                <?php Pjax::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
    </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                        
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <?php $form = ActiveForm::begin(['id'=> 'form-pegawai','options' => ['data-pjax' => true ]]); ?>
                            <input type="hidden" id="id_pegawai">
                          
                            <?= $form->field($model, 'kode_dokter_maping_simrs')->textInput(['maxlength' => true, 'id' => 'kode_simrs'])->hint('Abaikan Jika Tidak Ada Kode SIMRS') ?>     
                            
                             <?= 
                                $form->field($model, 'status_aktif_pegawai')->widget(Select2::classname(), [
                                    'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                                    'options' => [
                                        'placeholder' => 'Pilih...',
                                        'id'    =>'status_aktif_pegawai_edit'
                                    ],
                                    ]); 
                            ?>

                           
                            <div class="form-group float-sm-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" id="btnEdit" class="btn btn-primary" autocomplete="off">Simpan</button>
                            </div>

                             <?php ActiveForm::end(); ?>
                        </div>
                    </div>  
                </div>                
            
        </div>
    </div>
</div>

<!-- detail Modal -->
<!-- <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Detail Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'detail-pegawai']); ?> 

            
            <div class="modal-body">
                <div class="row">   
                    <div class="col">
                       
                            <div class="card-body">
                                <div class="invoice p-3 mb-3">  
                                    <div class="row invoice-info mb-4">
                                        <div class="col-sm-4 invoice-col">
                                            Nama Pegawai :
                                            <address>
                                                <strong id="nama_pegawai"></strong>
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            NIP/NRP :
                                            <address>
                                                <strong id="nip"></strong>
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            KODE SIMRS :
                                            <address>
                                                <strong id="kode_simrs"></strong>
                                            </address>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-4">
                                          
                                                <tr>
                                                    <th>Status Kepegawaian</th>
                                                    <td id="status_kepegawaian"></td>
                                                </tr>
                                               
                                        </table>
                                    </div>
                                </div>
                            </div>
                       
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div> -->

<script>
   

    $('#editModal').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id'); 

        $.ajax({
            url: '<?php echo Url::to(['pegawai/view/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                console.log('response : ', response.success);
                console.log('data : ', response.data);

                if (response.success === true) {      
                    var id = response.data.pegawai_id;
                    var kode_simrs = response.data.kode_dokter_maping_simrs;       
                    var status_aktif_pegawai = response.data.status_aktif_pegawai;       
                    var nip = response.data.id_nip_nrp;       
                    
                    
                    $('#id_pegawai').val(id);
                    $('#kode_simrs').val(kode_simrs);
                    $('#status_aktif_pegawai_edit').val(status_aktif_pegawai).trigger('change');
                     
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Terjadi kesalahan saat Mengambil data. Status: ' + textStatus + ' Error: ' + errorThrown);
            }
        });    

       

    });

     $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id       = $('#id_pegawai').val();
        var kode_simrs     = $('#kode_simrs').val();
        var status_aktif_pegawai     = $('#status_aktif_pegawai_edit').val();

      
             $.ajax({
                url: '<?php echo Url::to(['pegawai/update/']) ?>' + '?id=' + id,
                type: 'post',          
                data: {
                    kode_simrs     : kode_simrs,
                    status_aktif_pegawai     : status_aktif_pegawai,
                },
                success: function(response) {
                    console.log('response : ', response);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });
                        document.getElementById("form-pegawai").reset();
                        $('#editModal').modal('hide');                                 
                        $.pjax.reload('#pegawai-pjax', {timeout: 3000});

                    }else{
                        swal.fire({
                            title   : response.message,
                            icon    : "error",
                            timer   : 3000
                        });
                    }
                    
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan data.');
                }
            });
        });
       
    


</script>

