<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiPendidikanUmumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pendidikan Umum';
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
                                        'title' => 'Form Tambah Pendidikan Umum',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Pendidikan Umum', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>
                    </div>


                    <?php Pjax::begin(['id'=>'pendidikan']); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'options' => [
                            'id' => 'my-gridview'
                        ],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                        //    'kode',
                           'pendidikan_umum',
                           'kode_max_gol',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update}{delete}',
                                'buttons' => [
                                    
                                    

                                    'update' => function($kode,$model) {
                        
                                        return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                        [
                                            'title' => 'Ubah',
                                            'data' => [
                                                'toggle'    => 'modal',
                                                'target'    => '#editModal',
                                                'kode'        => $model->kode, 
                                                'pendidikan_umum'  => $model->pendidikan_umum,  
                                                'kode_max_gol'  => $model->kode_max_gol,  
                                            ],
                                        ]);
                                    },

                                
                                    'delete' => function ($kode,$model) {
                                        return Html::button('<b class="fa fa-trash"></b>', [
                                            'class' => 'btn btn-sm btn-danger',
                                            'data'  => [
                                                'toggle'    => 'modal',
                                                'target'    => '#delete-modal',
                                                'kode'        => $model->kode
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
                <h5 class="modal-title">Form Edit Pendidikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <?php $form = ActiveForm::begin(['id'=> 'form-edit-pendidikan']); ?>
                            
                                <?= $form->field($model, 'kode')->hiddenInput(['id'=>'kode'])->label(false); ?>

                                <?= $form->field($model, 'pendidikan_umum')->textInput(['maxlength' => true, 'id'=>'pendidikan_umum']) ?>

                                <?= $form->field($model, 'kode_max_gol')->textInput(['maxlength' => true, 'id'=>'kode_max']) ?>

                                <div class="form-group float-sm-right">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id'=>'btnEdit']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>  
                </div>

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
        var kode =  button.data('kode');
        var pendidikan =  button.data('pendidikan_umum');
        var kode_max_gol =  button.data('kode_max_gol');
      
        $('#kode').val(kode);     
        $('#pendidikan_umum').val(pendidikan);
        $('#kode_max').val(kode_max_gol);
    }); 

    $('#btnEdit').click(function(e) {
        
        e.preventDefault();

        var kode  = $('#kode').val();
        var pendidikan     = $('#pendidikan_umum').val();
        var kode_max_gol     = $('#kode_max').val();

        $.ajax({
            url: '<?php echo Url::to(['pegawai-pendidikan-umum/update/']) ?>' + '?id=' + kode,
            type: 'post',          
            data: {
                kode        : kode,
                pendidikan  : pendidikan,
                kode_max_gol: kode_max_gol,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    document.getElementById("form-edit-pendidikan").reset();
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#pendidikan #my-gridview', {timeout: 3000});

                }else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                        timer   : 3000
                    });
                }
                
            },
            error: function(e) {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
      
       
    });

     $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('kode'); 
        $('#id').val(id);        
    });

      $('#btnDelete').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['pegawai-pendidikan-umum/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#pendidikan #my-gridview', {timeout: 3000});
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
