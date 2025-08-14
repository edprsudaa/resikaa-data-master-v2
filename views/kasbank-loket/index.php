<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KasbankLoketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kasbank Loket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Kasbank Loket</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'form-kasbank-loket']); ?>    
                                <?php $form = ActiveForm::begin(); ?>                    
                                <div class="kasbank-loket-form">   
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?= $form->field($model, 'loket_pembayaran')->textInput(['maxlength' => true, 'id'=>'loket_pembayaran']) ?>
                                    </div>
                                    <div class="col-lg-2">
                                        <?=
                                            $form->field($model, 'lkasir')->dropDownList(
                                                    ['1' => 'Ya', '0' => 'Tidak'],
                                                    ['class' => 'form-control', 'prompt' => 'Pilih...', 'id'=>'lkasir']
                                            );
                                        ?> 
                                    </div>
                                    <div class="col-lg-2">
                                        <?=
                                            $form->field($model, 'lregistrasi')->dropDownList(
                                                    ['1' => 'Ya', '0' => 'Tidak'],
                                                    ['class' => 'form-control', 'prompt' => 'Pilih...', 'id'=>'lregistrasi']
                                            );
                                        ?> 
                                    </div>
                                  
                                    <div class="col-lg-2">
                                        <label for="" style="color:white">s</label>
                                        <?= Html::submitButton('<i class="fa fa-save"> Simpan</i>', ['class' => 'btn btn-success  btn-save btn-block btn-flat']) ?>
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
                                    <?php Pjax::begin(['id' => 'kasbank_loket']); ?>
                                        <div class="table-responsive">
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                            //    'kode',
                                                'loket_pembayaran',
                                                [
                                                    'attribute'=>'lkasir',
                                                    'value' => function ($model){
                                                        $status = [0 => 'Tidak', 1 => 'Ya'];
                                                        return $status[$model->lkasir];
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'lkasir',
                                                        'data' => [1 => 'Ya', 0 => 'Tidak'],
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                                // 'lkasir',
                                                [
                                                    'attribute'=>'lregistrasi',
                                                    'value' => function ($model){
                                                        $status = [0 => 'Tidak', 1 => 'Ya'];
                                                        return $status[$model->lregistrasi];
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'lregistrasi',
                                                        'data' => [1 => 'Ya', 0 => 'Tidak'],
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                                // 'lregistrasi',
                                                [
                                                    'attribute'=>'status',
                                                    'value' => function ($model){
                                                        $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                                        return $status[$model->status];
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'status',
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
                                                                    'loket_pembayaran'    => $model->loket_pembayaran,
                                                                    'lregistrasi'  => $model->lregistrasi,  
                                                                    'lkasir'  => $model->lkasir,  
                                                                    'status'  => $model->status,  
                                                                ],
                                                            ]);
                                                        },

                                                    
                                                        'delete' => function ($id, $model) {
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
                                                ]

                                                    
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
                            <input type="hidden" name="id" id="id_kasbank_loket">  
                                <?= $form->field($model, 'loket_pembayaran')->textInput(['maxlength' => true, 'id'=>'loket_pembayaran_edit']) ?>     

                                <?=
                                    $form->field($model, 'lkasir')->dropDownList(
                                            ['1' => 'Ya', '0' => 'Tidak'],
                                            ['class' => 'form-control', 'prompt' => 'Pilih...', 'id'=>'lkasir_edit']
                                    );
                                ?> 

                                <?=
                                    $form->field($model, 'lregistrasi')->dropDownList(
                                            ['1' => 'Ya', '0' => 'Tidak'],
                                            ['class' => 'form-control', 'prompt' => 'Pilih...', 'id'=>'lregistrasi_edit']
                                    );
                                ?> 

                                <?= 
                                    $form->field($model, 'status')->widget(Select2::classname(), [
                                        'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                                        'options' => ['placeholder' => 'Pilih...', 'id'=>'status'],
                                        ])->label('Status'); 
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

        var loket_pembayaran = $("#loket_pembayaran").val();
        var kasir = $("#lkasir").val();
        var registrasi = $("#lregistrasi").val();

        // console.log('kamar ', kamar);
        // console.log('skTarif ', skTarif);
        // console.log('biaya ', biaya);

        if (loket_pembayaran == "" || kasir == "" || registrasi == "") {
            swal.fire({
                title: "Harap Lengkapi Form yang Tersedia Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#loket_pembayaran").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['kasbank-loket/create']) ?>',
                type: 'post',
                data: {
                    loket_pembayaran : loket_pembayaran,
                    kasir : kasir,
                    registrasi : registrasi,
                },
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });
                    
                        $.pjax.reload('#kasbank_loket_pjax, #form-kasbank-loket', {timeout: 3000});       
                       

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
        var loket_pembayaran =  button.data('loket_pembayaran');
        var lkasir =  button.data('lkasir');
        var lregistrasi =  button.data('lregistrasi');
        var status =  button.data('status');
        $('#id_kasbank_loket').val(id);   
        $('#loket_pembayaran_edit').val(loket_pembayaran);   
        $('#lkasir_edit').val(lregistrasi).trigger('change');   
        $('#lregistrasi_edit').val(lregistrasi).trigger('change');   
        $('#status').val(status).trigger('change');   
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_kasbank_loket').val();
        var lkasir     = $('#lkasir_edit').val();
        var lregistrasi       = $('#lregistrasi_edit').val();
        var loket_pembayaran       = $('#loket_pembayaran_edit').val();
        var status       = $('#status').val();

        $.ajax({
            url: '<?php echo Url::to(['kasbank-loket/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                lkasir: lkasir,
                lregistrasi    : lregistrasi,
                status   : status,
                loket_pembayaran   : loket_pembayaran,
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
                   $.pjax.reload('#kasbank_loket_pjax, #form-kasbank-loket', {timeout: 3000});                        
                   

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
            url: '<?php echo Url::to(['kasbank-loket/delete/']) ?>' + '?id=' + id,
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
                     $.pjax.reload('#kasbank_loket_pjax, #form-kasbank-loket', {timeout: 3000});    
                    // $.pjax.reload('#kasbank_loket_pjax', {timeout: 3000});    

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
