<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PendaftaranKelasRawatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis Kelas Rawat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Jenis Kelas Rawat</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'form-kelas-rawat']); ?>    
                                <?php $form = ActiveForm::begin(); ?>                    
                            
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group ">
                                            <input type="text" name="kelasRawat" id="kelasRawat" class="form-control" placeholder="Inputkan Jenis Kelas Rawat..." autocomplete="off">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-success btn-flat btn-save"><i class="fa fa-save"> </i>Simpan</button>
                                            </span>
                                        </div>                                        
                                    </div> 
                                </div>    
                                
                                <?php ActiveForm::end(); ?>
                            <?php Pjax::end(); ?>
                            
                        </div>
                    </div>

                    <div class="card card-outline card-primary mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <?php Pjax::begin(['id' => 'kelas_rawat_pjax']); ?> 

                                            <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],

                                                    // 'kode',
                                                    'nama',
                                                    // 'kode_lama',
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
                                                    //'created_by',
                                                    //'created_at',
                                                    //'updated_by',
                                                    //'updated_at',
                                                    //'is_deleted',

                                                    [
                                                        'class' => 'yii\grid\ActionColumn',
                                                        'template' => '{update}{delete}',
                                                        'buttons' => [
                                                            'update' => function($kode, $model) {
                
                                                                return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                                [
                                                                    'title' => 'Ubah',
                                                                    'data' => [
                                                                        'toggle'    => 'modal',
                                                                        'target'    => '#editModal',
                                                                        'id'        => $model->kode, 
                                                                        'nama'    => $model->nama, 
                                                                        'aktif'  => $model->aktif,  
                                                                    ],
                                                                ]);
                                                            },

                                                        
                                                            'delete' => function ($kode, $model) {
                                                                return Html::button('<b class="fa fa-trash"></b>', [
                                                                    'class' => 'btn btn-sm btn-danger',
                                                                    'data'  => [
                                                                        'toggle'    => 'modal',
                                                                        'target'    => '#delete-modal',
                                                                        'id'        => $model->kode
                                                                    ],
                                                                ]);
                                                            },
                                                        ]
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
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Jenis Kelas Rawat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php 
                $form = ActiveForm::begin(['id'=>'form-edit']);             
            ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <input type="hidden" name="id" id="id_kelas_rawat">
                           
                            <?= $form->field($model, 'nama')->textInput(['id'=>'nama']) ?>


                            <?= 
                                $form->field($model, 'aktif')->widget(Select2::classname(), [
                                    'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                                    'options' => [
                                        'placeholder' => 'Pilih...',
                                        'id'    =>'aktif'
                                    ],
                                    ]); 
                            ?>

                        </div>
                    </div>  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btnEdit" class="btn btn-primary" autocomplete="off">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<!-- delete modal -->
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
                <input type="hidden" id="id" name="id">
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
     $('.btn-save').click(function(e){

        var nama = $("#kelasRawat").val();

        if (nama == "") {
            swal.fire({
                title: "Harap isi Nama Kelas Rawat Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#kelasRawat").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['pendaftaran-kelas-rawat/create']) ?>',
                type: 'post',
                data: {
                    nama : nama,
                },
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });
                        // document.getElementById("form-edit").reset();        
                       
                         $.pjax.reload('#kelas_rawat_pjax, #form-kelas-rawat', {timeout: 3000});                       

                    }else{
                        swal.fire({
                            title   : response.message,
                            icon    : "error",
                            timer   : 3000
                        });
                    }            
                    
                },
                error: function(xhr, status, error) {
                    // handle error response here
                    var errorMessage = xhr.responseText;
                    console.log(errorMessage); // log error message to console for debugging
                }
            });
        }
    }); 

     $('#editModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id =  button.data('id');
        var nama =  button.data('nama');
        var aktif =  button.data('aktif');

        $('#id_kelas_rawat').val(id);     
        $('#nama').val(nama);
        $('#aktif').val(aktif).trigger('change');
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_kelas_rawat').val();
        var nama     = $('#nama').val();
        var aktif  = $('#aktif').val();

        // console.log('kode : ', kode);

        $.ajax({
            url: '<?php echo Url::to(['pendaftaran-kelas-rawat/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                nama     : nama,
                aktif       : aktif,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    document.getElementById("form-edit").reset();
                    $('#editModal').modal('hide');    
                    $.pjax.reload('#kelas_rawat_pjax, #form-kelas-rawat', {timeout: 3000});

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

    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#btnDelete').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['pendaftaran-kelas-rawat/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                // console.log('response : ', response.success);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    $('#delete-modal').modal('hide');       
                    $.pjax.reload('#kelas_rawat_pjax, #form-kelas-rawat', {timeout: 3000});
                    // $.pjax.reload({container:"#negara"});

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
