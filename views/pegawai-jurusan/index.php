<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PegawaiJurusan;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiJurusanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Jurusan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <p class="float-sm-right">
                                <?php 
                                    Modal::begin([
                                        'id'    => 'addModal',
                                        'title' => 'Form Tambah Jurusan',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Jurusan', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>
                    </div>


                    <?php Pjax::begin(['id'=>'jurusan']); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'options' => [
                            'id' => 'my-gridview'
                        ],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'kode',
                                'value'     => function ($model){
                                    return $model->jenisPendidikan->pendidikan_umum;
                                },
                                'headerOptions'=>['style'=>'min-width:220px'],
                                'filter' => Select2::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'kode',
                                    'data' => $jenisPendidikan,
                                    'options' => [
                                        'placeholder' => 'Pilih...'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]),
                            ],

                           'kode_jurusan',
                           'nama_jurusan',
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
                                                'id'        => $model->kode_jurusan, 
                                                'jenis_pendidikan'    => $model->kode,
                                                'kode_jurusan'  => $model->kode_jurusan,  
                                                'nama_jurusan'  => $model->nama_jurusan,  
                                                'aktif'  => $model->aktif,  
                                            ],
                                        ]);
                                    },

                                
                                    'delete' => function ($url, $model) {
                                        return Html::button('<b class="fa fa-trash"></b>', [
                                            'class' => 'btn btn-sm btn-danger',
                                            'data'  => [
                                                'toggle'    => 'modal',
                                                'target'    => '#delete-modal',
                                                'id'        => $model->kode_jurusan
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
                <h5 class="modal-title">Form Edit Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php 
                $form = ActiveForm::begin(['id'=>'form-edit']); 
                $jenisPendidikan = PegawaiJurusan::getAllJenisPendidikan();              
            ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <input type="hidden" name="id" id="id_jurusan">
                            <?= $form->field($model, 'kode')->widget(Select2::classname(), [
                               
                                'data' => $jenisPendidikan,
                                'options' => [
                                    'placeholder' => 'Pilih...',
                                    'id' => 'jenisPendidikanKode',
                                    'disabled'=>true
                                    
                                ],
                                ]); 
                            ?>

                            <?= $form->field($model, 'kode_jurusan')->textInput(['id'=>'kode_jurusan', 'readonly'=>true]) ?>

                            <?= $form->field($model, 'nama_jurusan')->textInput(['maxlength' => true, 'id'=>'nama_jurusan']) ?>

                            <?= 
                                $form->field($model, 'aktif')->widget(Select2::classname(), [
                                    'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                                    'options' => [
                                        'placeholder' => 'Pilih...',
                                        'id'    =>'aktif'
                                    ],
                                    ]); 
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

    $('#editModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id =  button.data('id');
        var jenisPendidikanKode =  button.data('jenis_pendidikan');
        var kode_jurusan =  button.data('kode_jurusan');
        var nama_jurusan =  button.data('nama_jurusan');
        var aktif =  button.data('aktif');

        $('#id_jurusan').val(id);     
        $('#kode_jurusan').val(kode_jurusan);
        $('#nama_jurusan').val(nama_jurusan);
        $('#aktif').val(aktif).trigger('change');
        $('#jenisPendidikanKode').val(jenisPendidikanKode).trigger('change');
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_jurusan').val();
        var kode     = $('#jenisPendidikanKode').val();
        var kode_jurusan     = $('#kode_jurusan').val();
        var nama_jurusan  = $('#nama_jurusan').val();
        var aktif  = $('#aktif').val();

        console.log('kode : ', kode);

        $.ajax({
            url: '<?php echo Url::to(['pegawai-jurusan/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                kode_jurusan     : kode_jurusan,
                nama_jurusan       : nama_jurusan,
                aktif       : aktif,
                kode       : kode,
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
                    $.pjax.reload('#jurusan #my-gridview', {timeout: 3000});

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
            url: '<?php echo Url::to(['pegawai-jurusan/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#jurusan #my-gridview', {timeout: 3000});
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
