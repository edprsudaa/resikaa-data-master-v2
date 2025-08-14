<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\JenisIdentitas;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AksesUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5> <?= $this->title = 'Jenis Identitas';?></h5>
                    
                </div>
                <div class="card-body">
                   
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                    <hr>
                
                    <?php Pjax::begin(['id'=>'jenis-identitas']); ?>
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
                                        'attribute' => 'nama',
                                        // 'headerOptions' => ['style' => 'width:100px'],
                                    ],
                                   
                                    
                                    [
                                        'headerOptions' => ['style' => 'min-width: 120px;'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'contentOptions' => ['style' => 'text-align: center;'],
                                        'header' => 'Aksi',
                                        'template' => '{update}{delete}',
                                        // 'template' => '{view}{update}{delete}',
                                        'buttons' => [                        
                                            
                                            'update' => function($id, $model) {
                                
                                                return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                [
                                                    'title' => 'Ubah',
                                                    'data' => [
                                                        'toggle'    => 'modal',
                                                        'target'    => '#editModal',
                                                        'id'        => $model->id, 
                                                        'nama'=> $model->nama
                                                    ],
                                                ]);
                                            },

                                            'delete' => function ($id, $model) {
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

                        </div>
                    <?php Pjax::end(); ?>
                       
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Jenis Identitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-jenis-identitas',
                            'options' => [
                                'data-pjax' => true,
                            ]
                        ]); 
                        ?>

                        <input type="hidden" id="id">
                        <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id' => 'nama-edit']) ?>
                         

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
                <input type="hidden" id="idJenisIdentitas">
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
   

    $(document).on("beforeSubmit", "form#form-jenis-identitas", function (e) {

        var nama = $("#nama").val();
            $.ajax({
                url: '<?php echo Url::to(['jenis-identitas/create']) ?>',
                type: 'post',
                data: {
                    nama : nama
                },
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
        var nama = button.data('nama'); 

        $('#id').val(id);
        $('#nama-edit').val(nama);
    });

    $('#btnEdit').click(function(e) {

        e.preventDefault();

        var id       = $('#id').val();
        var nama     = $('#nama-edit').val();

        $.ajax({
            url: '<?php echo Url::to(['jenis-identitas/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                nama : nama,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                    });
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#jenis-identitas',{timeout:3000});   

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
        $('#idJenisIdentitas').val(id);        
    });

    $('#btnDelete').click(function(e) {
        e.preventDefault();

        var id  = $('#idJenisIdentitas').val();

        $.ajax({
            url: '<?php echo Url::to(['jenis-identitas/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success"
                    });
                    $('#delete-modal').modal('hide'); 
                    $.pjax.reload('#jenis-identitas', {timeout:3000});     

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

