<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiHariLiburSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data hari Libur';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Data Hari Libur</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <div class="card-header">
                            <h6>Form Hari Libur</h6>
                        </div>
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'form-hari-libur']); ?>
                                <?php $form = ActiveForm::begin([
                                    'options' => ['autocomplete' => 'off'],
                                ]); ?>                  
                                
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <?= 
                                                $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
                                                    'options' => [
                                                        'placeholder' => 'Tanggal Libur ...',
                                                        'id'        => 'tanggal_libur'
                                                    ],
                                                    'pluginOptions' => [
                                                        'autoclose' => true,
                                                        'format' => 'yyyy-mm-dd'
                                                    ]
                                                ]); 
                                            ?>
                                        </div>   
                                        <div class="col-lg-5">
                                            <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true, 'id'=>'keterangan_libur']) ?>
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
                        <div class="card-header">
                            <h6>Data Hari Libur</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <?php Pjax::begin(['id'=>'hari-libur']); ?>
                                            <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],

                                                    // 'id',
                                                    [
                                                        'attribute' => 'tanggal',
                                                        'filter' => DatePicker::widget([
                                                            'model' => $searchModel,
                                                            'attribute' => 'tanggal',
                                                            'options' => [
                                                                'class' => 'form-control',
                                                            ],
                                                            'pluginOptions' => [
                                                                'autoclose' => true,
                                                                'format' => 'yyyy-mm-dd',
                                                            ]
                                                        ])
                                                    ],
                                                    'keterangan',

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
                                                                        'id'        => $model->id, 
                                                                        'tanggal'      => $model->tanggal,
                                                                        'keterangan'      => $model->keterangan,    
                                                                    ],
                                                                ]);
                                                            },

                                                        
                                                            'delete' => function ($url, $model) {
                                                                return Html::button('<b class="fa fa-trash"></b>', [
                                                                    'class' => 'btn btn-sm btn-danger',
                                                                    'data'  => [
                                                                        'toggle'    => 'modal',
                                                                        'target'    => '#delete-modal',
                                                                        'id'        => $model->id
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
                <h5 class="modal-title">Form Edit Hari Libur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-edit-hari-libur']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id_hari_libur">
                                <?= $form->field($model, 'tanggal')->textInput(['maxlength' => true, 'id'=>'tanggal_edit','disabled'=>true]) ?>                               
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true, 'id'=>'keterangan_edit']) ?>                               
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
            url: '<?php echo Url::to(['pegawai-hari-libur/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                // console.log('response : ', response.success);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                    });
                    $('#delete-modal').modal('hide');       
                    $.pjax.reload('#hari-libur', {timeout: 3000});
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
        var tanggal =  button.data('tanggal');
        var keterangan =  button.data('keterangan');
        $('#id_hari_libur').val(id);     
        $('#tanggal_edit').val(tanggal);
        $('#keterangan_edit').val(keterangan); 
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_hari_libur').val();
        // var tanggal     = $('#tanggal_edit').val();
        var keterangan  = $('#keterangan_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['pegawai-hari-libur/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                keterangan       : keterangan
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                    });
                    document.getElementById("form-edit-hari-libur").reset();
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#hari-libur', {timeout: 3000});

                }else{
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

    $('.btn-save').click(function(e){

        var tanggal = $("#tanggal_libur").val();
        var keterangan = $("#keterangan_libur").val();

        if (tanggal == "" || keterangan =="") {
            swal.fire({
                title: "Harap isi Tanggal dan Keterangan Terlebih Dahulu!",
                icon: "warning",
            });        
            
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['pegawai-hari-libur/create']) ?>',
                type: 'post',
                data: {
                    tanggal : tanggal,
                    keterangan :keterangan
                },
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                        });
                        // document.getElementById("form-edit").reset();        
                       
                         $.pjax.reload('#hari-libur, #form-hari-libur', {timeout: 3000});                       

                    }else{
                        swal.fire({
                            title   : response.message,
                            icon    : "error",
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

