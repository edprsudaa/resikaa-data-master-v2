<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\Kabupaten;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KabupatenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Kabupaten/Kota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Data Kabupaten/Kota</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="float-sm-right">
                            <?php 
                                Modal::begin([
                                    'id'    => 'addModal',
                                    'title' => 'Form Tambah Kabupaten',
                                    'size'  => 'modal-lg',
                                    'toggleButton' => ['label' => '+ Tambah Kabupaten', 'class' => 'btn btn-success'],
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
                            <?php Pjax::begin(['id'=>'kabupaten-pjax']); ?>
                                <div class="table-responsive">
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            [
                                                'attribute' => 'kode_prov_kabupaten',
                                                'label'     => 'Kode Kabupaten/Kota'
                                            ],
                                            [
                                                'attribute' => 'nama',
                                                'label'     => 'Nama Kabupaten/Kota',
                                                
                                            ],
                                            [
                                                'attribute' => 'jenis',
                                                'value' => function ($model){
                                                    $jenis = ['KABUPATEN' => 'KABUPATEN', 'KOTA' => 'KOTA'];
                                                    return $jenis[$model->jenis];
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'jenis',
                                                        'data' => ['KABUPATEN' => 'KABUPATEN', 'KOTA' => 'KOTA'],
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                            ],

                                        //    'jenis',
                                        //    'kode_prov',
                                        [
                                            'attribute' => 'kode_prov',
                                            'value' => 'provinsi.nama',
                                            'label' => 'Provinsi',
                                            'filter'    => Select2::widget([
                                                'model' => $searchModel,
                                                'attribute' => 'kode_prov',
                                                'data' => ArrayHelper::map($provinsi,'kode','nama'),
                                                'options' => [
                                                    'placeholder' => 'Pilih...'
                                                ],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]),
                                        ],
                                        [
                                            'attribute' => 'aktif',
                                            'label'     => 'Status',
                                            'value'     => function ($model){
                                                $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                                return $status[$model->aktif];
                                            },
                                            'filter'    => Select2::widget([
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
                                                            'id'        => $model->kode_prov_kabupaten, 
                                                            'nama'      => $model->nama,
                                                            'jenis'      => $model->jenis,    
                                                            'kode_prov'      => $model->kode_prov,    
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
                                                            'id'        => $model->kode_prov_kabupaten
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
                <button type="submit" id="btnDelete" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Kabupaten / Kota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php 
                        $form = ActiveForm::begin(['id'=> 'form-kabupaten-edit','options' => ['data-pjax' => true ]]);
                        $provinsi = Kabupaten::getProvincies(); 
                        ?>     

                            <input type="hidden" name="id" id="id">

                            <?= 
                                $form->field($model, 'kode_prov')->widget(Select2::classname(), [
                                        'data' => $provinsi,
                                        'options' => [
                                            'placeholder' => 'Pilih...',
                                            'id' => 'kode_prov_edit',
                                            'disabled' => true
                                        ],
                                    ])->label('Provinsi'); 
                            ?>

                             <?= $form->field($model, 'kode_prov_kabupaten')->textInput(['maxlength' => true, 'id'=>'kode_prov_kab_edit', 'autocomplete'=>'off', 'disabled'=>true])->label('Kode Kabupaten/Kota') ?>

                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama_edit','autocomplete'=>'off'])->label('Nama Kabupaten/Kota') ?>

                            <?= 
                                $form->field($model, 'jenis')->widget(Select2::classname(), [
                                    'data' => ['KABUPATEN' => 'KABUPATEN', 'KOTA' => 'KOTA'],
                                    'options' => ['placeholder' => 'Pilih...', 'id'=>'jenis_edit'],
                                ])->label('Jenis Daerah'); 
                            ?>

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
    $('.btn-submit').click(function(e){

        var nama = $("#nama").val();
        var kode_prov = $("#kode_prov").val();
        var kode_prov_kab = $("#kode_prov_kab").val();
        var jenis = $("#jenis").val();
       
        $.ajax({
            url: '<?php echo Url::to(['kabupaten/create']) ?>',
            type: 'post',
            data: {
                nama : nama,
                kode_prov : kode_prov,
                kode_prov_kab : kode_prov_kab,
                jenis : jenis,
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
                }
                else if(response.status = 1){

                         swal.fire({
                            title   : response.message,
                            icon    : "error",
                            timer   : 4000
                        });
                        $('#addModal').modal('hide'); 
                        location.reload(true); 

                    }
              
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
            url: '<?php echo Url::to(['kabupaten/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#kabupaten-pjax', {timeout: 3000});
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

    $('#editModal').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        var nama = button.data('nama'); 
        var jenis = button.data('jenis'); 
        var kode_prov = button.data('kode_prov'); 
        var aktif = button.data('aktif');         

        $('#id').val(id);
        $('#kode_prov_edit').val(kode_prov).trigger('change');
        $('#kode_prov_kab_edit').val(id);
        $('#nama_edit').val(nama);
        $('#jenis_edit').val(jenis).trigger('change');       
        $('#status_edit').val(aktif).trigger('change');       

    });

    $('.btn-edit').click(function(e) {
        e.preventDefault();

        var id              = $('#id').val();
        var kode_kabupaten  = $('#id').val();
        var nama     = $('#nama_edit').val();
        var jenis = $('#jenis_edit').val();
        var kode_prov  = $('#kode_prov_edit').val();
        var aktif  = $('#status_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['kabupaten/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                kode_kabupaten : kode_kabupaten,
                nama: nama,
                jenis : jenis,
                kode_prov : kode_prov,
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
                    $.pjax.reload('#kabupaten-pjax, #form-kabupaten-edit', {timeout:3000});   

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
