<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisSkTarifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SK Tarif';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
           
            <div class="card card-primary">
                <div class="card-header">
                    <h5>SK Tarif</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="float-sm-right">
                                <button type="button" class="btn btn-success" id="buttonAdd" >
                                <i class="fa fa-plus"></i> Tambah SK Tarif
                                </button>
                              
                            </p>
                            
                        </div>
                    </div>


                    <?php Pjax::begin(['id' => 'my_pjax']); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'options' => [
                            'id' => 'my-gridview'
                        ],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                        //    'id',
                           'nomor',
                           'tanggal',
                           'keterangan:ntext',
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
                                'headerOptions'=>['style'=>'min-width:120px'],    
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update}{delete}',
                                'buttons' => [
                                  
                                    'update' => function($id, $model) {
                         
                                        return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                        [
                                            'title' => 'Ubah',
                                            'data' => [
                                                'toggle'    => 'modal',
                                                'target'    => '#editSkTarifModal',
                                                'id'        => $model->id, 
                                                'tanggal'   => $model->tanggal,
                                                'keterangan'=> $model->keterangan,   
                                                'nomor'     => $model->nomor,   
                                                'aktif'     => $model->aktif,   
                                            ],
                                        ]);
                                    },

                                    'delete' => function($url, $model) {
                                        return Html::a('<span class="btn btn-sm btn-danger mr-1"><b class="fa fa-trash"></b></span>', null,
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

<!-- tambah Modal -->
<div class="modal fade" id="addSkTarifModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Form SK Tarif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php Pjax::begin(['id' => 'pjax-modal']); ?>
            <?php $form = ActiveForm::begin(['id'=>'form-add-sk-tarif']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <div class="form-group">
                                <?= $form->field($model, 'nomor')->textInput(['maxlength' => true, 'id'=>'nomor']) ?>
                               
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
                                    'options' => [
                                        'id' => 'tanggal',
                                        'placeholder' => 'Masukan tanggal SK Tarif....',
                                        'autocomplete' => 'off',
                                    ],
                                    'removeButton' => false,
                                    'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'dd-mm-yyyy'
                                        ]
                                    ])->label('Tanggal SK');
                                ?>
                              
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'keterangan')->textarea(['rows' => 5, 'id'=>'keterangan-id']) ?>
                            </div>
                            
                        </div>
                    </div>  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="simpanSkTarif" class="btn btn-primary" autocomplete="off">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade" id="editSkTarifModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Form Edit SK Tarif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-edit-sk-tarif']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="sk_tarif_id" id="sk_tarif_id">
                                <?= $form->field($model, 'nomor')->textInput(['maxlength' => true, 'id'=>'nomor-edit']) ?>                               
                            </div>
                            
                            <div class="form-group">
                                <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
                                    'options' => [
                                        'id' => 'tanggal-edit',
                                        'placeholder' => 'Masukan tanggal SK Tarif....',
                                        'autocomplete' => 'off',
                                    ],
                                    'removeButton' => false,
                                    'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'yyyy-mm-dd',
                                        'autofocus' => false,
                                    ],
                                    ])->label('Tanggal SK');
                                ?>
                              
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'keterangan')->textarea(['rows' => 5, 'id'=>'keterangan-edit', 'value'=> $model->keterangan]) ?>
                            </div>

                            <div class="form-group">
                                <?= $form->field($model,'aktif')->widget(Select2::className(),[
                                    'data' =>  ['' => 'Pilih Status','1' => 'Aktif','0' => 'Tidak Aktif'],
                                    'options' => [
                                        'id'=>'aktif-edit',
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
                    <button type="submit" id="editSkTarif" class="btn btn-primary" autocomplete="off">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="modal-title">Delete SK Tarif</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['medis-sk-tarif/delete'],
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
                    <button type="submit" id="deleteSkTarif" class="btn btn-danger">Hapus</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">

    $('#buttonAdd').click(function(e){
        $('#addSkTarifModal').modal('show');
    }); 

    $('#simpanSkTarif').click(function(e) {
        e.preventDefault();

        var nomor       = $('#nomor').val();
        var tanggal     = $('#tanggal').val();
        var keterangan  = $('#keterangan-id').val();

        // console.log('nomor : ', nomor);
        // console.log('tanggal : ', tanggal);
        // console.log('keterangan : ', keterangan);

        if (nomor == "" || tanggal == "") {
            swal.fire({
                title: "Nomor dan Tanggal SK Tidak Boleh Kosong!",
                icon: "warning",
            });        
          
          $("#nomor").focus();
        }else{
             $.ajax({
                url: '<?php echo Url::to(['medis-sk-tarif/create']) ?>',
                type: 'post',          
                data: {
                    tanggal     : tanggal,
                    nomor       : nomor,
                    keterangan  : keterangan
                },
                success: function(response) {
                    // console.log('response : ', response.success);

                    if (response.success === true) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });
                        document.getElementById("form-add-sk-tarif").reset();
                        $('#addSkTarifModal').modal('hide');                                 
                        $.pjax.reload('#my_pjax #my-gridview', {timeout: 3000});

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

    $(document).on('click', '[data-toggle="modal"][data-target="#editSkTarifModal"]', function(){
        var id = $(this).data('id');
        var tanggal = $(this).data('tanggal');
        var keterangan = $(this).data('keterangan');
        var nomor = $(this).data('nomor');
        var aktif = $(this).data('aktif');
        
        // Set nilai dari input pada form modal
        $('#sk_tarif_id').val(id);
        $('#tanggal-edit').val(tanggal);
        $('#keterangan-edit').val(keterangan);
        $('#nomor-edit').val(nomor);
        $('#aktif-edit').val(aktif).trigger('change');
        
        // Tampilkan modal
        $('#editSkTarifModal').modal('show');
    });
   
    $('#editSkTarif').click(function(e) {
        e.preventDefault();

        var nomor       = $('#nomor-edit').val();
        var tanggal     = $('#tanggal-edit').val();
        var keterangan  = $('#keterangan-edit').val();
        var sk_tarif_id = $('#sk_tarif_id').val();
        var aktif       = $('#aktif-edit').val();

        // console.log('nomor : ', nomor);
        // console.log('tanggal : ', tanggal);
        // console.log('keterangan : ', keterangan);
        // console.log('id : ', sk_tarif_id);
        // console.log('aktif : ', aktif);

        if (nomor == "" || tanggal == "") {
            swal.fire({
                title: "Nomor dan Tanggal SK Tidak Boleh Kosong!",
                icon: "warning",
            });        
          
          $("#nomor").focus();
        }else{
             $.ajax({
                url: '<?php echo Url::to(['medis-sk-tarif/update/']) ?>' + '?id=' + sk_tarif_id,
                type: 'post',          
                data: {
                    tanggal     : tanggal,
                    nomor       : nomor,
                    keterangan  : keterangan,
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
                        document.getElementById("form-edit-sk-tarif").reset();
                        $('#editSkTarifModal').modal('hide');                                 
                        $.pjax.reload('#my_pjax #my-gridview', {timeout: 3000});

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

    $(document).on('click', '[data-toggle="modal"][data-target="#deleteModal"]', function() {
        var id = $(this).data('id');
        $('#id').val(id);
    });

    $('#deleteSkTarif').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['medis-sk-tarif/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#my_pjax #my-gridview', {timeout: 3000});

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
