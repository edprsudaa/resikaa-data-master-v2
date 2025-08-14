<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Negara;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NegaraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Negara';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
             <div class="card card-primary">
                <div class="card-header">
                    <h5>Negara</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'form-negara']); ?>    
                                <?php $form = ActiveForm::begin(); ?>                    
                            
                                <div class="row">
                                    <div class="col-lg-5">
                                        <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'id'=>'kode'])->label('Kode Negara') ?>
                                    </div>   
                                    <div class="col-lg-5">
                                         <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama'])->label('Nama Negara') ?>
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
                                         <?php Pjax::begin(['id'=>'negara']); ?>

                                            <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                'options' => [
                                                    'id' => 'my-gridview'
                                                ],
                                                'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                    [
                                                        'attribute'     => 'kode',
                                                        'label'         => 'Kode Negara',
                                                    ],
                                                    [
                                                        'attribute' => 'nama',
                                                        'label'     => 'Nama Negara'
                                                    ],
                                                [
                                                    'attribute'=>'aktif',
                                                    'label'     => 'Status',
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
                                                        'class' => 'yii\grid\ActionColumn',
                                                        'template' => '{update}{delete}',
                                                        'buttons' => [
                                                            
                                                           
                                                            'update' => function($id, $model) {
                                                
                                                                return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                                [
                                                                    'title' => 'Ubah',
                                                                    'data' => [
                                                                        'toggle'    => 'modal',
                                                                        'target'    => '#editNegaraModal',
                                                                        'id'        => $model->id, 
                                                                        'nama'      => $model->nama,
                                                                        'kode'      => $model->kode,    
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
           
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
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
                <button type="submit" id="deleteNegara" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="editNegaraModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Negara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-edit-negara']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id_negara">
                                <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'id'=>'kode']) ?>                               
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama']) ?>                               
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
                    <button type="submit" id="btnEditNegara" class="btn btn-primary" autocomplete="off">Simpan</button>
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

    $('#deleteNegara').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['negara/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#negara', {timeout: 3000});
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

    $('#editNegaraModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id =  button.data('id');
        var kode =  button.data('kode');
        var nama =  button.data('nama');
        var aktif =  button.data('aktif');
        $('#id_negara').val(id);     
        $('#kode').val(kode);
        $('#nama').val(nama);
        $('#aktif').val(aktif).trigger('change');   
    }); 

    $('#btnEditNegara').click(function(e) {
        e.preventDefault();

        var id  = $('#id_negara').val();
        var nama     = $('#nama').val();
        var kode  = $('#kode').val();
        var aktif       = $('#aktif').val();

        $.ajax({
            url: '<?php echo Url::to(['negara/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                nama     : nama,
                kode       : kode,
                aktif       : aktif
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    document.getElementById("form-edit-negara").reset();
                    $('#editNegaraModal').modal('hide');                                 
                    $.pjax.reload('#negara #my-gridview', {timeout: 3000});

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

        var nama = $("#nama").val();
        var kode = $("#kode").val();

        if (nama == "" || kode =="") {
            swal.fire({
                title: "Harap isi Kode dan Nama Negara Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#kode").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['negara/create']) ?>',
                type: 'post',
                data: {
                    nama : nama,
                    kode :kode
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
                       
                         $.pjax.reload('#negara_pjax, #form-negara', {timeout: 3000});                       

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



