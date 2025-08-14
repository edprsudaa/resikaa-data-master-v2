<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\widgets\Alert;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use app\components\Helper;
use app\widgets\SweetAlert;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MedisIcd9cm2010;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisIcd10cmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medis Icd9cm 2010';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Medis Icd9cm 2010</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="float-sm-right">
                            <?php 
                                Modal::begin([
                                    'id'    => 'addModal',
                                    'title' => 'Form Tambah ICD 9',
                                    'size'  => 'modal-lg',
                                    'toggleButton' => ['label' => '+ Tambah ICD 9', 'class' => 'btn btn-success'],
                                ]);
                                echo $this->render('_form', [
                                    'model' => $model
                                ]) ;

                                Modal::end();
                            ?>
                        </p>
                        
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?php Pjax::begin(['id'=>'icd-9-pjax']); ?>
                                <div class="table-responsive">
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                           
                                            'kode',
                                            'deskripsi:ntext',
                                          
                                            [
                                                'headerOptions'=>['style'=>'min-width:180px'], 
                                                'attribute' => 'aktif',
                                                'value' => function ($model) {
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
                                                'header' => 'Aksi',
                                                'headerOptions'=>['style'=>'min-width:120px'], 
                                                // 'headerOptions' => ['style' => 'min-width:160px'],
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
                                                                'kode'      => $model->kode,
                                                                'deskripsi'      => $model->deskripsi,    
                                                                'keterangan'      => $model->keterangan,    
                                                                'aktif'      => $model->aktif,    
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
                                                    // 'import' => function ($url, $model) {
                                                    //     return Html::a('<span class="btn btn-sm btn-warning"><b class="fa fa-upload"></b></span>', ['form-import', 'id' => $model['id'], 'kode' => $model['kode']], ['title' => 'Upload', 'id' => 'modal-btn-view']);
                                                    // }
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

<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit ICD 9</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['id'=> 'form-icd-9-edit','options' => ['data-pjax' => true ]]); ?>

        
                            <input type="hidden" name="id" id="id">

                            <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'autocomplete'=>'off', 'id'=>'kode_edit', 'readonly'=>true]) ?>

                            <?= $form->field($model, 'deskripsi')->textarea(['rows' => 4, 'id'=>'deskripsi_edit']) ?>

               
                            <?= $form->field($model, 'aktif')->widget(Select2::class, [
                                'data' =>  ['' => 'Pilih Status', '1' => 'Aktif', '0' => 'Tidak Aktif'],
                                'options' => [
                                    'id' => 'status_edit',
                                    'placeholder' => 'Pilih Status',
                                    'class' => 'form-control-sm'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]); ?>
                    


                            <div class="form-group float-sm-right">
                                <?= Html::submitButton(
                                'Simpan',
                                    [
                                        'class' => 'btn btn-success btn-edit',
                                        'status' => 'Diperbarui',
                                    ]
                                ) ?>
                            </div>

                         <?php ActiveForm::end(); ?>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>


<script>

    $('.btn-submit').click(function(e){

        var kode = $("#kode").val();
        var deskripsi = $("#deskripsi").val();
        var status = $("#status").val();

        if (kode == "") {
            swal.fire({
                title: "Harap isi kode Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#kode").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['medis-icd-9cm2010/create']) ?>',
                type: 'post',
                data: {
                    kode : kode,
                    status : status,
                    deskripsi : deskripsi,
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
                        $('#addModal').modal('hide');  
                        // $("#form-icd-9").trigger("reset"); 
                        $.pjax.reload('#icd-9-pjax', {timeout:3000});                         

                    }
                    // else if(response.status === 1){

                    //      swal.fire({
                    //         title   : response.message,
                    //         icon    : "error",
                    //         timer   : 3000
                    //     });
                    //     // $('#editModal').modal('hide'); 
                    //     //  $.pjax.reload('#icd-9-pjax, #form-icd-9-edit', {timeout:3000});   
 

                    // }
                    else{
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
    
    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#deleteBtn').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['medis-icd-9cm2010/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#icd-9-pjax', {timeout:3000});   

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

    $('#editModal').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        var kode = button.data('kode'); 
        var deskripsi = button.data('deskripsi'); 
        var aktif = button.data('aktif'); 

        $('#id').val(id);
        $('#kode_edit').val(kode);
        $('#deskripsi_edit').val(deskripsi);
        $('#status_edit').val(aktif).trigger('change');       

    });

    $('.btn-edit').click(function(e) {
        e.preventDefault();

        var id       = $('#id').val();
        var kode     = $('#kode_edit').val();
        var deskripsi = $('#deskripsi_edit').val();
        var status  = $('#status_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['medis-icd-9cm2010/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                kode : kode,
                deskripsi: deskripsi,
                status : status,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#icd-9-pjax, #form-icd-9-edit', {timeout:3000});   

                }
                else{
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