<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\models\PegawaiUnitPenempatan;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BpjskesMappingPoliNewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$unitPenempatan = PegawaiUnitPenempatan::find()->where(['aktif'=>1])->andWhere(['not',['kode_unitsub_maping_simrs' => null]])->orderBy(['nama'=>SORT_ASC])->all();

$this->title = 'Bpjs Mapping Poli';
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
                                        'title' => 'Form Tambah BPJSKes Mapping Poli',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah BPJSKes Mapping Poli', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>
                    </div>

                    <?php Pjax::begin(['id'=>'bpjskes-mapping']); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'bpjs_kode',
                            'bpjs_nama',
                            'bpjs_sub_kode',
                            'bpjs_sub_nama',
                            
                            [
                                'headerOptions' => ['style' => 'min-width: 350px;'],
                                'attribute' => 'unitPenempatan.nama',
                                'filter' => Select2::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'simrs_kode',
                                    'data' => \yii\helpers\ArrayHelper::map($unitPenempatan, 'kode', 'nama'),
                                    'options' => [
                                        'placeholder' => 'Pilih Berdasarkan Nama Poli...'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]),
                                
                            ],

                            [
                                'headerOptions' => ['style' => 'min-width: 150px;'],
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
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
                                                'bpjs_kode'=> $model->bpjs_kode,
                                                'bpjs_nama'  => $model->bpjs_nama,
                                                'bpjs_sub_kode'      => $model->bpjs_sub_kode,
                                                'bpjs_sub_nama'      => $model->bpjs_sub_nama,
                                                'simrs_kode'      => $model->simrs_kode,
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

<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit BPJSKes Mapping Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-bpjskes-mapping-edit',
                            'options' => [
                                'data-pjax' => true,
                            ]
                        ]); 

                       $unitPenempatan = PegawaiUnitPenempatan::find()->where(['aktif'=>1])->andWhere(['not',['kode_unitsub_maping_simrs' => null]])->orderBy(['nama'=>SORT_ASC])->all();
                        
                        ?>
                            <div class="card card-body">
                                <input type="hidden" name="id" id="id">
                                <?= $form->field($model, 'bpjs_kode')->textInput(['maxlength' => true, 'autocomplete'=>'off', 'id'=>'bpjs_kode_edit']) ?>

                                <?= $form->field($model, 'bpjs_nama')->textInput(['maxlength' => true,'autocomplete'=>'off','id'=>'bpjs_nama_edit']) ?>

                                <?= $form->field($model, 'bpjs_sub_kode')->textInput(['maxlength' => true, 'autocomplete'=>'off','id'=>'bpjs_sub_kode_edit']) ?>

                                <?= $form->field($model, 'bpjs_sub_nama')->textInput(['autocomplete'=>'off','id'=>'bpjs_sub_nama_edit']) ?>

                                <?= $form->field($model, 'simrs_kode')->widget(Select2::classname(), [
                                    'data' => \yii\helpers\ArrayHelper::map($unitPenempatan, 'kode', 'nama'),
                                    'language' => 'en',
                                    'options' => ['placeholder' => 'Pilih Poli Unit','id'=>'simrs_kode_edit'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label('Nama Poli Unit'); ?>

                                <div class="box-footer">
                                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success btn-block btn-flat', 'id'=>'btnEdit']) ?>
                                </div>
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
                <button type="submit" id="deleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("beforeSubmit", "form#form-bpjskes-mapping", function (e) {

        var form = $(this);
        var formData = form.serialize();       

            $.ajax({
                url: '<?php echo Url::to(['bpjskes-mapping-poli-new/create']) ?>',
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
                        $("#form-bpjskes-mapping").trigger("reset"); 
                        $.pjax.reload('#bpjskes-mapping', {timeout:3000});                         

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

    $('#editModal').on('show.bs.modal',function(e){
         
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        var bpjs_kode = button.data('bpjs_kode'); 
        var bpjs_nama = button.data('bpjs_nama'); 
        var bpjs_sub_kode = button.data('bpjs_sub_kode'); 
        var bpjs_sub_nama = button.data('bpjs_sub_nama'); 
        var simrs_kode = button.data('simrs_kode'); 

        $('#id').val(id);
        $('#bpjs_kode_edit').val(bpjs_kode);
        $('#bpjs_nama_edit').val(bpjs_nama);
        $('#bpjs_sub_kode_edit').val(bpjs_sub_kode);
        $('#bpjs_sub_nama_edit').val(bpjs_sub_nama);
        $('#simrs_kode_edit').val(simrs_kode).trigger('change');

    });

    $('#btnEdit').click(function(e) {

        e.preventDefault();

        var id       = $('#id').val();
        var bpjs_kode     = $('#bpjs_kode_edit').val();
        var bpjs_nama    = $('#bpjs_nama_edit').val();
        var bpjs_sub_kode  = $('#bpjs_sub_kode_edit').val();
        var bpjs_sub_nama  = $('#bpjs_sub_nama_edit').val();
        var simrs_kode  = $('#simrs_kode_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['bpjskes-mapping-poli-new/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                bpjs_kode : bpjs_kode,
                bpjs_nama: bpjs_nama,
                bpjs_sub_kode : bpjs_sub_kode,
                bpjs_sub_nama : bpjs_sub_nama,
                simrs_kode : simrs_kode,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#bpjskes-mapping', {timeout:3000});   

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

    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#deleteBtn').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['bpjskes-mapping-poli-new/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#bpjskes-mapping', {timeout:3000});   

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