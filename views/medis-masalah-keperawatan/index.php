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
/* @var $searchModel app\models\MedisMasalahKeperawatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Masalah Keperawatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Masalah Keperawatan</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'form-masalah-keperawatan']); ?>    
                            <?php $form = ActiveForm::begin(); ?>                    
                           
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($model,'parent_id')->widget(Select2::className(),[
                                        'data' =>  ArrayHelper::map($masalah_keperawatan,'id','rumpun'),
                                        'options' => [
                                            'id'=>'parent_id',
                                            'placeholder' => 'Pilih Parent...',
                                            'class'=>'form-control-sm'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ])->hint('<p style="font-weight:bold">*Kosongkan Jika Tidak Memiliki Parent</p>') 
                                    ?>
                                </div>
                                <div class="col-sm-7">
                                    <?= $form->field($model, 'deskripsi')->textInput(['id'=>'deskripsi']) ?>
                                </div>
                                <div class="col-sm-1">
                                    <label for="" style="color:white">s</label><br>
                                    <button type="button" class="btn btn-success btn-save"><i class="fa fa-save"></i> Tambah </button>
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
                                    <?php Pjax::begin(['id' => 'masalah_pjax']); ?>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                            //    'id',
                                            //    'parent_id',
                                            //    'kode',
                                            'deskripsi:ntext',
                                            [
                                                // 'headerOptions'=>['style'=>'min-width:320px'],    
                                                'attribute' => 'Referensi',
                                                    'value' => function ($model){
                                                        return Helper::getMasalahKeperawatan($model->parent_id);
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'parent_id',
                                                        'data' => ArrayHelper::map($masalah_keperawatan, 'id', 'rumpun'),
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                            //    'tujuan:ntext',
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
                                                                'parent_id'    => $model->parent_id,
                                                                'deskripsi'  => $model->deskripsi,  
                                                                'aktif'  => $model->aktif,  
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
                                    <?php Pjax::end(); ?>
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
                <h5 class="modal-title">Form Edit Intervensi Keperawatan</h5>
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
                            <input type="hidden" name="id" id="id_masalah_keperawatan">

                            <?= $form->field($model,'parent_id')->widget(Select2::className(),[
                                    'data' =>  ArrayHelper::map($masalah_keperawatan,'id','rumpun'),
                                    'options' => [
                                        'id'=>'parent_id_edit',
                                        'placeholder' => 'Pilih Parent...',
                                        'class'=>'form-control-sm',
                                        'disabled' => true
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])
                            ?>

                            <?= $form->field($model, 'deskripsi')->textArea(['rows'=> '3','id'=>'deskripsi_edit']) ?>

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

        var parent = $("#parent_id").val();
        var deskripsi = $('#deskripsi').val();

        // console.log('kamar ', kamar);
        // console.log('skTarif ', skTarif);
        // console.log('biaya ', biaya);

        if (deskripsi == "") {
            swal.fire({
                title: "Harap Lengkapi Deskripsi Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#deskripsi").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['medis-masalah-keperawatan/create']) ?>',
                type: 'post',
                data: {
                    parent : parent,
                    deskripsi : deskripsi
                },
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });
                    
                        $.pjax.reload('#masalah_pjax, #form-masalah-keperawatan', {timeout: 3000});       
                       

                    }else{
                        swal.fire({
                            title   : response.message,
                            icon    : "error",
                            timer   : 3000
                        });
                    }            
                    
                },
                error: function (error) {
                }
            });
        }
    }); 

    $('#editModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id =  button.data('id');
        var parent_id =  button.data('parent_id');
        var deskripsi =  button.data('deskripsi');
        var aktif =  button.data('aktif');
        $('#id_masalah_keperawatan').val(id);    
        $('#deskripsi_edit').val(deskripsi);
        $('#parent_id_edit').val(parent_id).trigger('change');   
        $('#aktif').val(aktif).trigger('change');   
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_masalah_keperawatan').val();
        var deskripsi     = $('#deskripsi_edit').val();
        var aktif       = $('#aktif').val();
        var parent       = $('#parent_id_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['medis-masalah-keperawatan/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                deskripsi: deskripsi,
                aktif    : aktif,
                parent   : parent,
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
                    $.pjax.reload('#masalah_pjax', {timeout: 3000});                           
                   

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
            url: '<?php echo Url::to(['medis-masalah-keperawatan/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#masalah_pjax', {timeout: 3000});

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
