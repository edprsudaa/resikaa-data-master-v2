<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PendaftaranDebiturDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Debitur Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
           <div class="card card-primary">
                <div class="card-header">
                    <h5>Debitur Detail</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'formDebiturPjax']); ?>    
                                <?php $form = ActiveForm::begin(); ?>                    
                            
                                <div class="row">

                                    <div class="col-lg-2">
                                        <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'id'=>'kode']) ?>
                                    </div> 

                                    <div class="col-lg-3">
                                         <?= $form->field($model,'debitur_kode')->widget(Select2::className(),[
                                            'data' =>  ArrayHelper::map($debitur,'kode','nama'),
                                            'options' => [
                                                'placeholder' => 'Pilih Debitur ...',
                                                'id'    => 'debitur'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]) 
                                        ?>
                                    </div>   
                                    <div class="col-lg-5">
                                        <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama']) ?>
                                    </div>   
                                    <div class="col-lg-2">
                                        <label for="" style="color:white">s</label><br>
                                        <?= Html::submitButton('<i class="fa fa-save"> Simpan</i>', ['class' => 'btn btn-success  btn-save btn-block btn-flat']) ?>
                                       
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
                                        <?php Pjax::begin(['id'=>'debiturDetailPjax']); ?>
                                            <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],

                                                'kode',
                                                [
                                                    'attribute' => 'debitur_kode',
                                                    'value' => 'debitur.nama',
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'debitur_kode',
                                                        'data' => ArrayHelper::map($debitur, 'kode', 'nama'),
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                                'nama',
                                                //'created_by',
                                                //'created_at',
                                                //'updated_by',
                                                //'updated_at',
                                                //'aktif',
                                                //'deleted_at',
                                                //'deleted_by',
                                                //'kode_lama',

                                                [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'template' => '{update}{delete}',
                                                    'buttons' => [
                                                        'update' => function($id, $model) {
                                            
                                                            return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                            [
                                                                'title' => 'Ubah',
                                                                'data' => [
                                                                    'toggle'    => 'modal',
                                                                    'target'    => '#editModal',
                                                                    'id'        => $model->kode, 
                                                                    'nama'      => $model->nama,
                                                                    'debitur'   => $model->debitur_kode,    
                                                                    'aktif'     => $model->aktif,   
                                                                ],
                                                            ]);
                                                        },

                                                    
                                                        'delete' => function ($url, $model) {
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
                <h5 class="modal-title">Form Edit Debitur Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-edit-debitur-detail']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <div class="form-group">
                                <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'id'=>'kode_detail', 'readOnly'=>true]) ?>                               
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="id_debitur_detail" id="id_debitur_detail">
                                 <?= $form->field($model,'debitur_kode')->widget(Select2::className(),[
                                    'data' =>  ArrayHelper::map($debitur,'kode','nama'),
                                    'options' => [
                                        'id'=>'debitur_kode',
                                        'disabled'=>true
                                    ],
                                ]) 
                                ?>                             
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama_detail']) ?>                               
                            </div>

                            <div class="form-group">
                                <?= $form->field($model,'aktif')->widget(Select2::className(),[
                                    'data' =>  ['' => 'Pilih Status','1' => 'Aktif','0' => 'Tidak Aktif'],
                                    'options' => [
                                        'id'=>'aktif',
                                        'placeholder' => 'Pilih Status',
                                        'class'=>'form-control-sm'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) 
                                ?>
                            </div>
                            
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
                <button type="submit" id="deleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
     $('.btn-save').click(function(e){

        var nama = $("#nama").val();
        var kode = $("#kode").val();
        var debitur = $("#debitur").val();

        if (nama == "" || debitur =="" || kode =="") {
            swal.fire({
                title: "Harap isi Kode , Debitur dan Debitur Detail Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#kode").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['pendaftaran-debitur-detail/create']) ?>',
                type: 'post',
                data: {
                    nama : nama,
                    debitur :debitur,
                    kode :kode,
                },
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 4000
                        });
                        // document.getElementById("form-edit").reset();        
                       
                        $.pjax.reload('#debiturDetailPjax, #formDebiturPjax', {timeout: 3000});                       

                    }else{
                        swal.fire({
                            title   : response.message,
                            icon    : "error",
                            text   : response.data,
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

     $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id_debitur_detail').val(id);        
    });

    $('#deleteBtn').click(function(e) {
        e.preventDefault();

        var id  = $('#id_debitur_detail').val();

        $.ajax({
            url: '<?php echo Url::to(['pendaftaran-debitur-detail/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                // console.log('response : ', response.success);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 4000  
                    });
                    $('#delete-modal').modal('hide');       
                    $.pjax.reload('#debiturDetailPjax, #formDebiturPjax', {timeout: 4000});    

                }else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                        timer   : 4000
                    });
                }
                
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });

    });

    $('#editModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id =  button.data('id');
        var kode =  button.data('id');
        var debitur =  button.data('debitur');
        var nama =  button.data('nama');
        var aktif =  button.data('aktif');
        $('#id_debitur_detail').val(id);     
        $('#debitur_kode').val(debitur);
        $('#nama_detail').val(nama);
        $('#kode_detail').val(kode);
        $('#aktif').val(aktif).trigger('change');   
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_debitur_detail').val();
        var nama     = $('#nama_detail').val();
        var kode     = $('#kode_detail').val();
        var debitur  = $('#debitur_kode').val();
        var aktif       = $('#aktif').val();

        $.ajax({
            url: '<?php echo Url::to(['pendaftaran-debitur-detail/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                nama     : nama,
                debitur       : debitur,
                aktif       : aktif,
                kode       : kode,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 4000  
                    });
                    document.getElementById("form-edit-debitur-detail").reset();
                    $('#editModal').modal('hide');                                 
                     $.pjax.reload('#debiturDetailPjax, #formDebiturPjax', {timeout: 3000});    

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
