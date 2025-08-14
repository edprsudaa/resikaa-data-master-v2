<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\Kabupaten;
use app\models\Kecamatan;
use yii\bootstrap4\Modal;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KecamatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Kecamatan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
           <div class="card card-primary">
                <div class="card-header">
                    <h5>Data Kecamatan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <div class="row">
                          
                            <p class="float-sm-right">
                                <?php 
                                    Modal::begin([
                                        'id'    => 'addModal',
                                        'title' => 'Form Tambah Kecamatan',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Kecamatan', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>


                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <?php Pjax::begin(['id'=>'kecamatan']); ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute' => 'kode_prov_kab_kecamatan',
                                        'label'     => 'Kode Kecamatan',
                                    ],
                                    [
                                        'attribute' => 'nama',
                                        'label'     => 'Nama Kecamatan'
                                    ],
                                    [
                                        'attribute' => 'kode_prov_kab',
                                        'label'     => 'Kabupaten',
                                        'value'     => function ($model){                                
                                            return $model->kabupaten->nama;
                                        }
                                    ],
                                    [
                                        'attribute' => 'kode_prov',
                                        'label'     => 'Provinsi',
                                        'value'     => function ($model){                                
                                            return $model->kabupaten->provinsi->nama;
                                        }
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
                                //'created_at',
                                //'created_by',
                                //'updated_at',
                                //'updated_by',
                                //'is_deleted',

                                [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}{delete}',
                                        'buttons' => [
                                            // 'view' => function($url, $model) {
                                            //     return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fa fa-search-plus"></b></span>', ['view', 'id' => $model['kode_prov_kab_kecamatan']], ['title' => 'View', 'id' => 'modal-btn-view']);
                                            // },
                                           'update' => function($id, $model) {
                                                
                                                return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                [
                                                    'title' => 'Ubah',
                                                    'data' => [
                                                        'toggle'    => 'modal',
                                                        'target'    => '#editModal',
                                                        'kode_prov_kab_kecamatan' => $model->kode_prov_kab_kecamatan, 
                                                        'nama'      => $model->nama,
                                                        'kode_prov_kab'      => $model->kode_prov_kab,    
                                                        'kode_prov'      => $model->kode_prov,    
                                                        'aktif'      => $model->aktif,    
                                                    ],
                                                ]);
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::button('<b class="fa fa-trash"></b>', [
                                                    'class' => 'btn btn-sm btn-danger',
                                                    'data'  => [
                                                        'toggle'    => 'modal',
                                                        'target'    => '#delete-modal',
                                                        'id'        => $model->kode_prov_kab_kecamatan
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
                <h5 class="modal-title">Form Edit Kecamatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php 
                        $form = ActiveForm::begin(['id'=> 'form-kecamatan-edit','options' => ['data-pjax' => true ]]);
                        $provinsi = Kabupaten::getProvincies();
                        $kabupaten = Kecamatan::getAllKabupaten();
                        ?>     

                            <input type="hidden" name="id" id="id">

                             <?= 
                                $form->field($model, 'kode_prov')->widget(Select2::classname(), [
                                        'data' => $provinsi,
                                        'options'   => [
                                            'placeholder' => 'Pilih...',
                                            'id'        => 'kode_provinsi',
                                            'disabled'  => true
                                        ],            
                                    ])->label('Provinsi'); 
                            ?>

                             <?= 
                                $form->field($model, 'kode_prov_kab')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map($kabupaten, 'kode_prov_kabupaten','nama'),
                                        'options'   => [
                                            'placeholder' => 'Pilih...',
                                            'id'        => 'kode_kabupaten',
                                            'disabled'  => true
                                        ],            
                                    ])->label('Kabupaten/Kota'); 
                            ?>

                            <?= $form->field($model, 'kode_prov_kab_kecamatan')->textInput(['maxlength' => true, 'id'=>'kode_kecamatan', 'disabled'=>true])->label('Kode Kecamatan') ?>

                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama_kecamatan'])->label('Nama Kecamatan') ?>

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
    $(document).on("beforeSubmit", "form#form-kecamatan", function (e) {

        var form = $(this);
        var formData = form.serialize();       

            $.ajax({
                url: '<?php echo Url::to(['kecamatan/create']) ?>',
                type: 'post',
                data: formData,
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.status === 200) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });
                        $('#addModal').modal('hide');  
                        $("#form-kecamatan").trigger("reset"); 
                        $.pjax.reload('#kecamatan', {timeout:3000});                         

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

    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#deleteBtn').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['kecamatan/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                // console.log('response : ', response.success);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    $('#delete-modal').modal('hide');       
                    $.pjax.reload('#kecamatan', {timeout:3000});   

                }else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                        html: 'Pesan : ' + '<pre>' + JSON.stringify(response.data, null, 4) + '</pre>',
                        icon    : "error",
                        allowOutsideClick: false
                    });
                }
                
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus data.');
            }
        });

    }); 

    $('#editModal').on('show.bs.modal',function(e){

        var button = $(e.relatedTarget);
        var id = button.data('kode_prov_kab_kecamatan'); 
        var kode_kecamatan = button.data('kode_prov_kab_kecamatan'); 
        var nama = button.data('nama'); 
        var kode_kabupaten = button.data('kode_prov_kab'); 
        var kode_provinsi = button.data('kode_prov'); 
        var aktif = button.data('aktif');         

        $('#id').val(id);
        $('#kode_provinsi').val(kode_provinsi).trigger('change');
        $('#kode_kabupaten').val(kode_kabupaten).trigger('change');
        $('#nama_kecamatan').val(nama);   
        $('#kode_kecamatan').val(kode_kecamatan);   
        $('#status_edit').val(aktif).trigger('change');       

    });

    $('.btn-edit').click(function(e) {
        e.preventDefault();

        var id              = $('#id').val();
        var kode_provinsi   = $('#kode_provinsi').val();
        var kode_kabupaten  = $('#kode_kabupaten').val();
        var kode_kecamatan  = $('#kode_kecamatan').val();
        var nama_kecamatan  = $('#nama_kecamatan').val();
        var aktif  = $('#status_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['kecamatan/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                kode_provinsi : kode_provinsi,
                kode_kabupaten : kode_kabupaten,
                kode_kecamatan : kode_kecamatan,
                nama_kecamatan: nama_kecamatan,
                aktif : aktif,
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
                    $.pjax.reload('#kecamatan, #form-kecamatan-edit', {timeout:3000});   

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
