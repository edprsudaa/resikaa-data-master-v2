<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use app\components\Helper;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\MedisTindakan;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisTindakanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'Medis Tindakan';
$this->params['breadcrumbs'][] = 'Medis Tindakan';
?>
<div class="container-fluid">
   
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Medis Tindakan</h3>
                </div>
                <div class="card-body">
                     
                    <div class="row">                      
                        <div class="col">
                            <p class="float-sm-right">                               
                                <?= Html::button('<i class="fa fa-plus"></i> Tambah Medis Tindakan', [ 'class' => 'btn btn-success', 'onclick' => 'modalAddTindakan()' ]); ?>                              
                                
                                <!-- <?= Html::a('Download Format File Import', ['download'], ['class' => 'btn btn-primary']) ?> -->
                            </p>
                        </div>
                        
                    </div>

                    <?php Pjax::begin(['id' => 'pjax_tindakan']); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'options' => [
                                'id' => 'my-gridview-tindakan'
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'headerOptions'=>['style'=>'min-width:320px'],    
                                    'attribute' => 'Referensi',
                                    'value' => function ($model){
                                        return Helper::getTindakan($model->parent_id);
                                    },
                                    'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'parent_id',
                                        'data' => ArrayHelper::map($tindakan, 'id', 'rumpun'),
                                        'options' => [
                                            'placeholder' => 'Pilih...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]),
                                ],
                            
                            'deskripsi:ntext',   
                            'kode_jenis',
                                [
                                    'headerOptions'=>['style'=>'min-width:130px'],
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
                            
                                [
                                    'headerOptions'=>['style'=>'min-width:130px','class'=>'text-center'],
                                    'class' => 'yii\grid\ActionColumn',
                                    'contentOptions' => ['class'=>'text-center'],
                                    'header'=>'Tarif Tindakan',
                                    'template' => '{tarif}',
                                    'buttons' => [
                                    
                                        'tarif' => function($url, $model) {
                                            return Html::a('<span class="btn btn-sm btn-secondary"><b class="fa fa-credit-card"></b></span>', ['add-tarif-tindakan', 'id' => $model['id']], ['title' => 'Tarif Tindakan', 'id' => 'modal-btn-tarif']);
                                        },
                                    ]
                                ],
                                [
                                    'headerOptions'=>['style'=>'min-width:150px'],
                                    'class' => 'yii\grid\ActionColumn',
                                    'contentOptions' => ['class'=>'text-center'],
                                    'template' => '{update}{delete}',
                                    'buttons' => [

                                        'update' => function($url, $model) {
                            
                                            return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                            [
                                                'title' => 'Ubah',
                                                'data' => [
                                                    'toggle'    => 'modal',
                                                    'target'    => '#editTindakanModal',
                                                    'id'        => $model->id, 
                                                    'parent'    => $model->parent_id,
                                                    'deskripsi' => $model->deskripsi,
                                                    'kode_jenis'=> $model->kode_jenis,
                                                    'aktif'     => $model->aktif
                                                ],
                                            ]);
                                        },
                                    
                                        // 'update' => function($id, $model) {
                                        //     return Html::a('<span class="btn btn-sm btn-default mr-1"><b class="fas fa-pencil-alt"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Update', 'id' => 'modal-btn-view']);
                                        // },
                                        'delete' => function($url, $model) {
                                            return Html::a('<span class="btn btn-sm btn-danger mr-2"><b class="fa fa-trash"></b></span>', null,
                                            [
                                                'title' => 'Delete', 
                                                'data'  => [
                                                    'toggle'=>'modal',
                                                    'target'=>'#deleteModal',
                                                    'id' => $model->id,
                                                ],
                                            ]);
                                        },

                                    ]
                                ],
                            ],
                            'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                            'pager' => [
                                'class' => 'yii\bootstrap4\LinkPager',
                            ],
                            'layout' => "{summary}\n<div class='table-responsive' style='overflow-x: auto;'>{items}</div>\n{pager}",
                        ]);?>

                    <?php Pjax::end(); ?>

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
<div class="modal fade" id="editTindakanModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Form Edit Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-edit-tindakan']); ?> 
                <div class="modal-body">
                    <div class="col-md-12">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id">
                                    <label for="parent">Parent</label>
                                    <?php
                                        $selectedParent ='';
                                        echo Select2::widget([
                                            'name' => 'parent',
                                            'value' =>  $selectedParent,
                                            'data' =>$dataParent,
                                            'options'       => [
                                                'id'          =>'parent',
                                                'placeholder' => 'Pilih Tindakan',
                                                'class'       =>'form-control-sm'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear'  => true
                                            ],
                                        ]);
                                    ?>
                                </div>   
                                
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="kode_jenis">Kode Jenis</label>
                                    <input type="text" name="kode_jenis" id="kode_jenis" class="form-control" required></input>
                                </div> 
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 2, 'id'=>'deskripsi', 'value'=> $model->deskripsi]) ?>                                    
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model,'aktif')->widget(Select2::className(),[
                                    'data' =>  ['' => 'Pilih Status','1' => 'Aktif','0' => 'Tidak Aktif'],
                                    'options' => [
                                        'id'=>'aktif_tindakan',
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="editTindakan" class="btn btn-success">Simpan</button>
                </div>
             <?php ActiveForm::end(); ?>
           
        </div>
    </div>
</div>

<div class="modal fade" id="mymodal" tabindex="false" data-keyboard='false' role="dialog" aria-labelledby="myModalLabel"></div>

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="modal-title">Hapus Tindakan</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['medis-tindakan/delete'],
                ]);
            ?>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="hidden" id="id" name="id">
                        <h6>Anda akan menghapus data berikut?</h6>
                    </div>                    
                </div>
               
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="deleteTindakan" class="btn btn-danger">Hapus</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<script>
    function modalAddTindakan() {

        $.ajax({
            url: '<?= Yii::$app->urlManager->createUrl('medis-tindakan/add-form-tindakan') ?>',
            type: 'POST',
            success: function(output) {
                // console.log('ouput: ', output);
            $('#mymodal').html(output);
            $('#mymodal').modal({
                backdrop: 'static',
                keyboard: false
            });

            }
        });
    }

   $(document).on('click', '[data-toggle="modal"][data-target="#deleteModal"]', function() {
        var id = $(this).data('id');
        $('#id').val(id);
    });

    $('#deleteTindakan').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['medis-tindakan/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                // console.log('response : ', response.success);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    $('#deleteModal').modal('hide');                                 
                    $.pjax.reload('#pjax_tindakan', {timeout: 3000});

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

    $(document).on('click', '[data-toggle="modal"][data-target="#editTindakanModal"]', function() {

        var id          = $(this).data('id');
        var kode_jenis  = $(this).data('kode_jenis');
        var deskripsi   = $(this).data('deskripsi');
        var aktif       = $(this).data('aktif');

        var parent = $(this).data('parent');
        
        $('#id').val(id);
        $('#kode_jenis').val(kode_jenis);
        $('#deskripsi').val(deskripsi);
        $('#aktif_tindakan').val(aktif).trigger('change');
        $('#parent').val(parent).trigger('change');

    });

     $('#editTindakan').click(function(e) {
        e.preventDefault();

        var id              = $('#id').val();
        var kode_jenis      = $('#kode_jenis').val();
        var deskripsi       = $('#deskripsi').val();
        var aktif_tindakan  = $('#aktif_tindakan').val();
        var parent          = $('#parent').val();

        // console.log(id);
        // console.log(kode_jenis);
        // console.log(deskripsi);
        // console.log(aktif_tindakan);
        // console.log(parent);

        if (kode_jenis == "" || deskripsi == "" || parent == "" ) {
            swal.fire({
                title: "Kode Jenis, Deskripsi, dan Parent Tidak Boleh Kosong!",
                icon: "warning",
            });        
          
          $("#parent").focus();
        }else{
             $.ajax({
                url: '<?php echo Url::to(['medis-tindakan/update/']) ?>' + '?id=' + id,
                type: 'post',          
                data: {
                    kode_jenis      : kode_jenis,
                    deskripsi       : deskripsi,
                    aktif           : aktif_tindakan,
                    parent          : parent
                },
                success: function(response) {
                    console.log('response : ', response);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });
                        document.getElementById("form-edit-tindakan").reset();
                        $('#editTindakanModal').modal('hide');                                 
                        $.pjax.reload('#pjax_tindakan #my-gridview-tindakan', {timeout: 3000});

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
        }
       
    });

  

</script>

