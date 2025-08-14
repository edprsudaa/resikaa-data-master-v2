<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\McuPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MCU Paket';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Paket MCU</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <div class="card-header">
                            <h6>Form Mcu Paket</h6>
                        </div>
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'form-mcu-paket']); ?>
                                <?php $form = ActiveForm::begin([
                                    'options' => ['autocomplete' => 'off'],
                                ]); ?>   

                                <div class="row">
                                        <div class="col-lg-5">
                                           <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id' => 'nama_paket']) ?>
                                        </div>   
                                        <div class="col-lg-5">
                                            <?= $form->field($model,'jenis_paket')->widget(Select2::className(),[
                                            'data' =>  ['' => 'Pilih Type','1' => 'Umum','2' => 'Instansi', '3' => 'Umum Instansi'],
                                                'options' => [
                                                    'id'=>'jenis_paket',
                                                    'placeholder' => 'Pilih Jenis Paket',
                                                    'class'=>'form-control-sm'
                                                ],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]) 
                                            ?>
                                           
                                        </div>   
                                        <div class="col-lg-2">
                                            <label for="" style="color:white">s</label>
                                            <?= Html::submitButton('<i class="fa fa-save"> Simpan</i>', ['class' => 'btn btn-success  btn-save btn-block btn-flat']) ?>
                                            
                                        </div>
                                    
                                    </div>      


                                <?php ActiveForm::end(); ?>
                          
                            <?php Pjax::end(); ?>
                        </div>
                    </div>

                     <div class="card card-outline card-primary mt-4">
                        <div class="card-header">
                            <h6>Data MCU Paket</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <?php Pjax::begin(['id'=>'mcu-paket']); ?>

                                            <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                  
                                                    'nama',
                                                    [
                                                        'attribute'=>'jenis_paket',
                                                        'value' => function ($model) {
                                                            $JenisPaket = [1 => 'Umum', 2 => 'Instansi', 3 => 'Umum Instansi'];
                                                            return $JenisPaket[$model->jenis_paket];
                                                        },
                                                        'filter' => Select2::widget([
                                                            'model' => $searchModel,
                                                            'attribute' => 'jenis_paket',
                                                            'data' => [1 => 'Umum', 2 => 'Instansi', 3 => 'Umum Instansi'],
                                                            'options' => [
                                                                'placeholder' => 'Pilih...'
                                                            ],
                                                            'pluginOptions' => [
                                                                'allowClear' => true
                                                            ],
                                                        ]),
                                                    ],
                                                   
                                                     [
                                                        'attribute'=>'is_active',
                                                        'value' => function ($model){
                                                            $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                                            return $status[$model->is_active];
                                                        },
                                                        'filter' => Select2::widget([
                                                            'model' => $searchModel,
                                                            'attribute' => 'is_active',
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
                                                                        'is_active'      => $model->is_active,    
                                                                        'jenis_paket'      => $model->jenis_paket,    
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


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit MCU Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-edit-mcu-paket']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id_mcu_paket">
                                 <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id' => 'nama_paket_edit']) ?>                             
                            </div>
                            <div class="form-group">
                                <?= $form->field($model,'jenis_paket')->widget(Select2::className(),[
                                    'data' =>  ['1' => 'Umum','2' => 'Instansi', '3' => 'Umum Instansi'],
                                    'options' => [
                                        'id'=>'jenis_paket_edit',
                                        'class'=>'form-control-sm'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) 
                                ?>
                                            
                            </div>
                            <div class="form-group">
                                <?= $form->field($model,'is_active')->widget(Select2::className(),[
                                    'data' =>  ['1' => 'Aktif','0' => 'Tidak Aktif'],
                                        'options' => [
                                            'id'=>'is_active_edit',
                                            'placeholder' => 'Pilih Status ',
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


<script>
    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#btnDelete').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['mcu-paket/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#mcu-paket', {timeout: 3000});
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

    $('#editModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id =  button.data('id');
        var nama =  button.data('nama');
        var is_active =  button.data('is_active');
        var jenis_paket =  button.data('jenis_paket');
        $('#id_mcu_paket').val(id);     
        $('#nama_paket_edit').val(nama);
        $('#jenis_paket_edit').val(jenis_paket).trigger('change'); 
        $('#is_active_edit').val(is_active).trigger('change'); 
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_mcu_paket').val();
        var nama    = $('#nama_paket_edit').val();
        var jenis_paket  = $('#jenis_paket_edit').val();
        var is_active  = $('#is_active_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['mcu-paket/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                nama       : nama,
                jenis_paket       : jenis_paket,
                is_active       : is_active,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    document.getElementById("form-edit-mcu-paket").reset();
                    $('#editModal').modal('hide');                                 
                   $.pjax.reload('#mcu-paket', {timeout: 3000});

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

    $('.btn-save').click(function(e){

        var nama = $("#nama_paket").val();
        var jenis_paket = $("#jenis_paket").val();

        if (nama == "" || jenis_paket =="") {
            swal.fire({
                title: "Harap isi Nama dan Jenis Paket Terlebih Dahulu!",
                icon: "warning",
            });        
            
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['mcu-paket/create']) ?>',
                type: 'post',
                data: {
                    nama : nama,
                    jenis_paket :jenis_paket
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
                       
                         $.pjax.reload('#mcu-paket, #form-mcu-paket', {timeout: 3000});                       

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

    



    
</script>