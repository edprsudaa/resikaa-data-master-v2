<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiStatusKepegawaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Kepegawaian';
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
                                        'title' => 'Form Tambah Status Kepegawaian',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Status Kepegawaian', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>
                    </div>


                    <?php Pjax::begin(['id'=>'status_kepegawaian']); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'options' => [
                                'id' => 'my-gridview'
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'status',
                                [
                                    'attribute'=>'kategori',
                                    'value' => function ($model){
                                        $status = [1 => 'ASN', 2 => 'Kontrak', 3 => 'OutSourching'];
                                        return $status[$model->kategori];
                                    },
                                    'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'kategori',
                                        'data' => [1 => 'ASN', 2 => 'Kontrak', 3 => 'OutSourching'],
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
                                                    'id'        => $model->id, 
                                                    'status'    => $model->status,
                                                    'kategori'  => $model->kategori,  
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
                <h5 class="modal-title">Form Edit Negara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id'=>'form-edit']); ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id_status">
                                <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'id'=>'status']) ?>                               
                            </div>
                            <?= 
                                $form->field($model, 'kategori')->widget(Select2::classname(), [
                                    'data' => [1 => 'ASN', 2 => 'Kontrak', 3 => 'OutSourching'],
                                    'options' => [
                                        'id'    => 'kategori',
                                        'placeholder' => 'Pilih...'
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
    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#btnDelete').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['pegawai-status-kepegawaian/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#status_kepegawaian #my-gridview', {timeout: 3000});
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

    $('#editModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id =  button.data('id');
        var status =  button.data('status');
        var kategori =  button.data('kategori');
        $('#id_status').val(id);     
        $('#status').val(status);
        $('#kategori').val(kategori).trigger('change');
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id  = $('#id_status').val();
        var status     = $('#status').val();
        var kategori  = $('#kategori').val();

        $.ajax({
            url: '<?php echo Url::to(['pegawai-status-kepegawaian/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                status     : status,
                kategori       : kategori,
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
                    $.pjax.reload('#status_kepegawaian #my-gridview', {timeout: 3000});

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
