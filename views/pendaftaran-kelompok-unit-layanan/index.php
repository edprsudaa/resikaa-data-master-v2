<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\components\Helper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PendaftaranKelompokUnitLayananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelompok Unit Layanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Kelompok Unit Layanan</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'form-kelompok-unit-layanan']); ?>    
                                <?php $form = ActiveForm::begin(); ?>                    
                            
                                <div class="row">
                                    <div class="col-lg-5">
                                         <?= $form->field($model,'unit_id')->widget(Select2::className(),[
                                            'data' =>  ArrayHelper::map($unit_penempatan,'kode','nama'),
                                            'options' => [
                                                'placeholder' => 'Pilih Unit Penempatan ...',
                                                'id'    => 'unit_id'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]) 
                                        ?>
                                    </div>   
                                    <div class="col-lg-5">
                                        <?= $form->field($model,'type')->widget(Select2::className(),[
                                            'data' =>  ['' => 'Pilih Type','1' => 'IGD','2' => 'RAWAT JALAN REGULER','3' => 'RAWAT INAP','4' => 'PENUNJANG','5' => 'RAWAT JALAN UTAMA'],
                                            'options' => [
                                                'id'=>'type_id',
                                                'placeholder' => 'Pilih Type',
                                                'class'=>'form-control-sm'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]) 
                                        ?>
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
                    
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <?= Html::a('Create Pendaftaran Kelompok Unit Layanan', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div> -->

                    <div class="card card-outline card-primary mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <?php Pjax::begin(['id'=>'kelompok-unit-layanan-pjax']); ?>
                                            <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],

                                                    // 'id',
                                                    [
                                                        'attribute' => 'unit_id',
                                                        'value' => 'unit.nama',
                                                        'filter' => Select2::widget([
                                                            'model' => $searchModel,
                                                            'attribute' => 'unit_id',
                                                            'data' => ArrayHelper::map($unit_penempatan, 'kode', 'nama'),
                                                            'options' => [
                                                                'placeholder' => 'Pilih...'
                                                            ],
                                                            'pluginOptions' => [
                                                                'allowClear' => true
                                                            ],
                                                        ]),
                                                    ],
                                                    [
                                                        'attribute'=>'type',
                                                        'value' => function ($model){
                                                            $status = [1=> 'IGD', 2=> 'RAWAT JALAN REGULER', 3=>'RAWAT INAP', 4=>'PENUNJANG', 5=>'RAWAT JALAN UTAMA'];
                                                            return $status[$model->type];
                                                        },
                                                        'filter' => Select2::widget([
                                                            'model' => $searchModel,
                                                            'attribute' => 'type',
                                                            'data' => [1=> 'IGD', 2=> 'RAWAT JALAN REGULER', 3=>'RAWAT INAP', 4=>'PENUNJANG', 5=>'RAWAT JALAN UTAMA'],
                                                            'options' => [
                                                                'placeholder' => 'Pilih...'
                                                            ],
                                                            'pluginOptions' => [
                                                                'allowClear' => true
                                                            ],
                                                        ]),
                                                    ],
                                                //'created_at',
                                                //'created_by',
                                                //'updated_at',
                                                //'updated_by',
                                                //'is_deleted',

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
                                                                        'unit_id'      => $model->unit_id,
                                                                        'type'   => $model->type,       
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



<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Kelompok Unit Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-edit-kelompok-unit-layanan']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <input type="hidden" name="id_kelompok_unit" id="id_kelompok_unit">
                            <?= $form->field($model,'unit_id')->widget(Select2::className(),[
                                'data' =>  ArrayHelper::map($unit_penempatan,'kode','nama'),
                                'options' => [
                                    'id'    => 'unit_id_edit',
                                    'disabled'=>true
                                ],
                            ]) 
                            ?>
                                                    
                            <?= $form->field($model,'type')->widget(Select2::className(),[
                                'data' =>  ['' => 'Pilih Type','1' => 'IGD','2' => 'RAWAT JALAN REGULER','3' => 'RAWAT INAP','4' => 'PENUNJANG','5' => 'RAWAT JALAN UTAMA'],
                                'options' => [
                                    'id'=>'type_id_edit',
                                    'placeholder' => 'Pilih Type',
                                    'class'=>'form-control-sm'
                                ],
                            ]) 
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
                <button type="submit" id="deleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-save').click(function(e){

        var unit = $("#unit_id").val();
        var type = $("#type_id").val();

        if (unit == "" || type =="") {
            swal.fire({
                title: "Harap Pilih Unit dan Type Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#unit_id").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['pendaftaran-kelompok-unit-layanan/create']) ?>',
                type: 'post',
                data: {
                    unit : unit,
                    type : type
                },
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });      
                       
                        $.pjax.reload('#kelompok-unit-layanan-pjax, #form-kelompok-unit-layanan', {timeout:3000});                       

                    }else if(response.success === 200){

                         swal.fire({
                            title   : response.message,
                            icon    : "error",
                            timer   : 3000
                        });

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

     $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#deleteBtn').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['pendaftaran-kelompok-unit-layanan/delete/']) ?>' + '?id=' + id,
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
                   $.pjax.reload('#kelompok-unit-layanan-pjax, #form-kelompok-unit-layanan', {timeout:3000});   

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
        var unit =  button.data('unit_id');
        var type =  button.data('type');
        $('#id_kelompok_unit').val(id); 
        $('#unit_id_edit').val(unit).trigger('change');     
        $('#type_id_edit').val(type).trigger('change');     
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_kelompok_unit').val();
        var unit     = $('#unit_id_edit').val();
        var type  = $('#type_id_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['pendaftaran-kelompok-unit-layanan/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                unit     : unit,
                type       : type,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    document.getElementById("form-edit-kelompok-unit-layanan").reset();
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#kelompok-unit-layanan-pjax, #form-kelompok-unit-layanan', {timeout:3000});   

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
