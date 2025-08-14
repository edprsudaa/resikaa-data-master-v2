<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisKamarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Kamar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><?= Html::encode($this->title) ?></h3>                        
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div class="card-body">      
                            <?php $form = ActiveForm::begin(); ?>                    
                           
                            <div class="row">
                                <div class="col-sm-3">
                                    <?= $form->field($model,'unit_id')->widget(Select2::className(),[
                                        'data' =>  ArrayHelper::map($unit_penempatan,'kode','nama'),
                                            'options' => [
                                                'id'=>'kodeUnit',
                                                'placeholder' => 'Pilih Unit',
                                                'class'=>'form-control-sm'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]) 
                                    ?>
                                </div>
                                <div class="col-sm-2">
                                    <?= $form->field($model,'kelas_rawat_kode')->widget(Select2::className(),[
                                        'data' =>  ArrayHelper::map($kelas_rawat,'kode','nama'),
                                        'options' => [
                                            'id'=>'kelasRawat',
                                            'placeholder' => 'Pilih Kelas Rawat',
                                            'class'=>'form-control-sm'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]) 
                                    ?>
                                </div>
                                <div class="col-sm-2">
                                    <?= $form->field($model, 'no_kamar')->textInput(['maxlength' => true, 'id'=>'nomorKamar']) ?>
                                </div>
                                <div class="col-sm-2">                                    
                                   <?= $form->field($model, 'no_kasur')->textInput(['maxlength' => true, 'id'=>'nomorKasur']) ?>
                                </div>

                                 <div class="col-sm-2">
                                    <?= $form->field($model,'cadangan')->widget(Select2::className(),[
                                        'data' => [
                                            0 => 'Utama',
                                            1 => 'Cadangan',
                                        ],
                                        'options' => [
                                            'id'=>'kategoriBed',
                                            'placeholder' => 'Kategori Bed',
                                            'class'=>'form-control-sm'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]) 
                                    ?>
                                </div>
                                
                                <div class="col-sm-1">
                                    <label for="" style="color:white">s</label><br>
                                    <button type="button" class="btn btn-success btn-save"><i class="fa fa-save"></i> Tambah </button>
                                </div>
                            </div>      
                            
                            <?php ActiveForm::end(); ?>
                            
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <?= Html::a('Create Medis Kamar', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div> -->

                    <div class="card card-outline card-primary mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <?php Pjax::begin(['id' => 'kamar']); ?>  

                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'options' => [
                                                'id' => 'my-gridview'
                                            ],
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
                                                    'attribute' => 'kelas_rawat_kode',
                                                    'value' => 'kelasrawat.nama',
                                                    'headerOptions'=>['style'=>'min-width:220px'],
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'kelas_rawat_kode',
                                                        'data' => ArrayHelper::map($kelas_rawat, 'kode', 'nama'),
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                            'no_kamar',
                                            'no_kasur',
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
                                            [
                                                'attribute' => 'kondisi',
                                                 'value' => function ($model){
                                                    $kondisi = [1 => 'Baik', 2 => 'Dalam Perbaikan', 3 => 'Rusak'];
                                                    return $kondisi[$model->kondisi];
                                                  
                                                },
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'kondisi',
                                                    'data' =>[1 => 'Baik', 2 => 'Dalam Perbaikan', 3 => 'Rusak'],
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),
                                            ],

                                            [
                                                'attribute' => 'cadangan',
                                                 'value' => function ($model){
                                                    $kondisi = [0 => 'Utama', 1 => 'Cadangan'];
                                                    return $kondisi[$model->cadangan];
                                                  
                                                },
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'cadangan',
                                                    'data' =>[0 => 'Utama', 1 => 'Cadangan'],
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
                                                'headerOptions'=>['style'=>'min-width:160px'],    
                                                'class' => 'yii\grid\ActionColumn',
                                                    'template' => '{update}{delete}',
                                                    'buttons' => [
                                                        // 'view' => function($url, $model) {
                                                        //     return Html::a('<span class="btn btn-sm btn-default"><b class="fa fa-search-plus"></b></span>', ['view', 'id' => $model['id']], ['title' => 'View', 'id' => 'modal-btn-view']);
                                                        // },
                                                        // 'update' => function($id, $model) {
                                                        //     return Html::a('<span class="btn btn-sm btn-default"><b class="fas fa-pencil-alt"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Update', 'id' => 'modal-btn-view']);
                                                        // },
                                                        // 'delete' => function($url, $model) {
                                                        //     return Html::a('<span class="btn btn-sm btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.', 'method' => 'post', 'data-pjax' => false],]);
                                                        // }

                                                        'update' => function($id, $model) {
                        
                                                                return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                                [
                                                                    'title' => 'Ubah',
                                                                    'data' => [
                                                                        'toggle'    => 'modal',
                                                                        'target'    => '#editModal',
                                                                        'id'        => $model->id, 
                                                                        'unit_id'   => $model->unit_id,
                                                                        'kelas_rawat_kode'  => $model->kelas_rawat_kode,  
                                                                        'no_kamar'  => $model->no_kamar,  
                                                                        'no_kasur'  => $model->no_kasur,  
                                                                        'aktif'  => $model->aktif,  
                                                                        'kondisi'  => $model->kondisi,  
                                                                        'cadangan'  => $model->cadangan, 
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

                                                // ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                                            ],
                                            'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                                            'pager' => [
                                                'class' => 'yii\bootstrap4\LinkPager',
                                            ],
                                            'layout' => "{summary}\n<div class='table-responsive' style='overflow-x: auto;'>{items}</div>\n{pager}",
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
                <h5 class="modal-title">Form Edit Kamar</h5>
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
                            <input type="hidden" name="id" id="id_kamar">
                            <?= $form->field($model,'unit_id')->widget(Select2::className(),[
                                'data' =>  ArrayHelper::map($unit_penempatan,'kode','nama'),
                                    'options' => [
                                        'id'=>'unit',
                                        'placeholder' => 'Pilih...',
                                        'disabled'=>true
                                    ],
                                ]) 
                            ?>

                            <?= $form->field($model,'kelas_rawat_kode')->widget(Select2::className(),[
                                'data' =>  ArrayHelper::map($kelas_rawat,'kode','nama'),
                                'options' => [
                                    'id'=>'kelas',
                                    'placeholder' => 'Pilih Kelas Rawat',
                                    'disabled'=>true
                                ],
                            ]) 
                            ?>

                             <?= $form->field($model, 'no_kamar')->textInput(['maxlength' => true, 'id'=>'nomor_kamar']) ?>

                            <?= $form->field($model, 'no_kasur')->textInput(['maxlength' => true, 'id'=>'nomor_kasur']) ?>

                            <?= $form->field($model,'aktif')->widget(Select2::className(),[
                                'data' =>  ['' => 'Pilih Status','1' => 'Aktif','0' => 'Tidak Aktif'],
                                'options' => [
                                    'id'=>'aktif',
                                    'placeholder' => 'Pilih Status',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) 
                            ?>

                            <?= $form->field($model,'kondisi')->widget(Select2::className(),[
                                'data' =>  ['' => '--Pilih--',1 => 'Baik', 2 => 'Dalam Perbaikan', 3 => 'Rusak'],
                                'options' => [
                                    'id'=>'kondisi',
                                    'placeholder' => 'Pilih Status',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) 
                            ?>

                            <?= $form->field($model,'cadangan')->widget(Select2::className(),[
                                'data' =>  ['' => '--Pilih--', 0 => 'Utama', 1 => 'Cadangan'],
                                'options' => [
                                    'id'=>'cadangan',
                                    'placeholder' => 'Pilih kategori',
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

        var kode_unit = $("#kodeUnit").val();
        var kelas_rawat = $('#kelasRawat').val();
        var nomor_kasur = $('#nomorKasur').val();
        var nomor_kamar = $('#nomorKamar').val();
        var kategori_bed = $('#kategoriBed').val();

        // console.log('tindakan ', tindakan_id);
        // console.log('unit ', unit_id);
        // console.log('kelas ', kelas);

        if (kode_unit == "" || kelas_rawat == "" || nomor_kasur =="" || nomor_kamar =="") {
            swal.fire({
                title: "Harap Lengkapi Unit, Kelas Rawat, Nomor Kasur, dan Nomor Kamar Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#kodeUnit").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['medis-kamar/create/']) ?>',
                type: 'post',
                data: {
                    kode_unit : kode_unit,
                    kelas_rawat : kelas_rawat,
                    nomor_kasur : nomor_kasur,
                    nomor_kamar : nomor_kamar,
                    kategori_bed : kategori_bed,
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
                    
                        $('#nomorKasur').val('');
                        $('#nomorKamar').val('');    
                        $.pjax.reload('#kamar', {timeout: 3000});
                        

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
        var unit_id =  button.data('unit_id');
        var kelas_rawat_kode =  button.data('kelas_rawat_kode');
        var no_kamar =  button.data('no_kamar');
        var no_kasur =  button.data('no_kasur');
        var aktif =  button.data('aktif');
        var kondisi =  button.data('kondisi');
        var kategori_bed =  button.data('cadangan');

        $('#id_kamar').val(id);     
        $('#nomor_kamar').val(no_kamar);
        $('#nomor_kasur').val(no_kasur);
        $('#aktif').val(aktif).trigger('change');
        $('#unit').val(unit_id).trigger('change');
        $('#kelas').val(kelas_rawat_kode).trigger('change');
        $('#kondisi').val(kondisi).trigger('change');
        $('#cadangan').val(kategori_bed).trigger('change');
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id          = $('#id_kamar').val();
        var unit_id     = $('#unit').val();
        var kelas_rawat_kode = $('#kelas').val();
        var no_kamar  = $('#nomor_kamar').val();
        var no_kasur  = $('#nomor_kasur').val();
        var aktif     = $('#aktif').val();
        var kondisi     = $('#kondisi').val();
        var kategoriBed     = $('#cadangan').val();

        // console.log('kode : ', kode);

        $.ajax({
            url: '<?php echo Url::to(['medis-kamar/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                unit_id         : unit_id,
                kelas_rawat_kode: kelas_rawat_kode,
                aktif           : aktif,
                no_kamar        : no_kamar,
                no_kasur        : no_kasur,
                kondisi        : kondisi,
                kategori_bed        : kategoriBed,
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
                     $.pjax.reload('#kamar', {timeout: 3000});         
                    // $.pjax.reload('#kamar #my-gridview', {timeout: 3000});
                     $("#filter-header").load(location.href + " #filter-header");    

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
            url: '<?php echo Url::to(['medis-kamar/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#kamar', {timeout: 3000});
                    // $.pjax.reload('#kamar #my-gridview', {timeout: 3000});
                      $("#filter-header").load(location.href + " #filter-header");   
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
</script>
