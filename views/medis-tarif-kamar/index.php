<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\components\Helper;
use app\models\MedisKamar;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use app\models\PegawaiUnitPenempatan;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisTarifKamarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarif Kamar';
$this->params['breadcrumbs'][] = $this->title;

$unit = PegawaiUnitPenempatan::find()->where(['aktif'=> 1,'is_deleted' => null])->orderBy(['nama'=> SORT_ASC])->all();

// echo "<pre>";
// print_r($sk_tarif);
// die;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Tarif Kamar</h5>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div  class="card-body">  
                            <?php Pjax::begin(['id' => 'form-tarif-kamar']); ?>    
                            <?php $form = ActiveForm::begin(); ?>                    
                           
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($model,'kamar_id')->widget(Select2::className(),[
                                        'data' =>  ArrayHelper::map($kamar,'kode','name'),
                                        'options' => [
                                            'id'=>'id_kamar',
                                            'placeholder' => 'Pilih Kamar',
                                            'class'=>'form-control-sm'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]) 
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                   <?= $form->field($model,'sk_tarif_id')->widget(Select2::className(),[
                                        'data' =>  ArrayHelper::map($sk_tarif,'id','nomor'),
                                        'options' => [
                                            'id'=>'skTarifKamar',
                                            'placeholder' => 'Pilih SK Tarif',
                                            'class'=>'form-control-sm'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]) 
                                    ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'biaya')->input('number',['id'=>'biayaKamar']) ?>
                                </div>
                               
                                
                                <div class="col-sm-1">
                                    <label for="" style="color:white">s</label>
                                    <button type="button" class="btn btn-success btn-save"><i class="fa fa-save"></i> Tambah </button>
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
                                    <?php Pjax::begin(['id' => 'tarif-kamar']); ?>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'options' => [
                                                'id' => 'my-gridview'
                                            ],
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                [
                                                    'label' => 'Unit', 
                                                    'attribute' => 'selectedUnit',
                                                    'value' => 'kamar.unit.nama', 
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'selectedUnit',
                                                        'data' =>  ArrayHelper::map($unit,'kode','nama'),
                                                        'options' => [
                                                            'placeholder' => 'Pilih Berdasarkan Nama Unit...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],

                                                [
                                                    'attribute' => 'kamar_id',
                                                    // 'value' => 'kamar.no_kamar',
                                                    'value' => function ($model){
                                                        return Helper::getKamarUnit($model->kamar_id);
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'kamar_id',
                                                        'data' => ArrayHelper::map($allKamar, 'kode', 'name'),
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                                [
                                                    'attribute' => 'sk_tarif_id',
                                                    'value' => 'sktarif.nomor',
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'sk_tarif_id',
                                                        'data' => ArrayHelper::map($sk_tarif, 'id', 'nomor'),
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                            'biaya',
                                            //'created_at',
                                            //'created_by',
                                            //'updated_at',
                                            //'updated_by',
                                            //'is_deleted',

                                            [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'template' => '{update}{delete}',
                                                    'buttons' => [
                                                       
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
                                                                    'kamar_id'    => $model->kamar_id,
                                                                    'sk_tarif_id'  => $model->sk_tarif_id,  
                                                                    'biaya'  => $model->biaya,  
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
                <h5 class="modal-title">Form Edit Tarif Kamar</h5>
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
                            <input type="hidden" name="id" id="id_tarif_kamar">

                            <?= $form->field($model,'kamar_id')->widget(Select2::className(),[
                                'data' =>  ArrayHelper::map($allKamar,'kode','name'),
                                'options' => [
                                    'id'=>'kamar_id',
                                    'placeholder' => 'Pilih Kamar',
                                    'class'=>'form-control-sm',
                                     'disabled'=>true
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) 
                            ?>

                            <?= $form->field($model,'sk_tarif_id')->widget(Select2::className(),[
                                'data' =>  ArrayHelper::map($sk_tarif,'id','nomor'),
                                'options' => [
                                    'id'=>'id_sk_tarif',
                                    'placeholder' => 'Pilih SK Tarif',
                                    'class'=>'form-control-sm',
                                    
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) 
                            ?>

                            <?= $form->field($model, 'biaya')->input('number',['maxlength'=>true, 'id'=>'biaya']) ?>
                          

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

        var kamar = $("#id_kamar").val();
        var skTarif = $('#skTarifKamar').val();
        var biaya = $('#biayaKamar').val();

        // console.log('kamar ', kamar);
        // console.log('skTarif ', skTarif);
        // console.log('biaya ', biaya);

        if (kamar == "" || skTarif == "" || biaya =="") {
            swal.fire({
                title: "Harap Lengkapi Nama Kamar, SK Tarif, dan Biaya Terlebih Dahulu!",
                icon: "warning",
            });        
            
            $("#id_kamar").focus();
        }
        else {

            $.ajax({
                url: '<?php echo Url::to(['medis-tarif-kamar/create']) ?>',
                type: 'post',
                data: {
                    kamar : kamar,
                    skTarif : skTarif,
                    biaya : biaya,
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
                        $.pjax.reload({
                            container: '#tarif-kamar',
                            timeout: 3000,
                        });
                        $.pjax.reload({
                            container: '#form-tarif-kamar',
                            timeout: 3000,
                        });
                        // $.pjax.reload('#tarif-kamar, #my-gridview, #form-tarif-kamar ', {timeout: 3000});

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
        var kamar_id =  button.data('kamar_id');
        var sk_tarif_id =  button.data('sk_tarif_id');
        var biaya =  button.data('biaya');


        $('#id_tarif_kamar').val(id);
        $('#id_sk_tarif').val(sk_tarif_id).trigger('change');
        $('#kamar_id').val(kamar_id).trigger('change');   
        $('#biaya').val(biaya);     
    }); 

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id          = $('#id_tarif_kamar').val();
        var sk_tarif_id = $('#id_sk_tarif').val();
        var kamar_id    = $('#kamar_id').val();
        var biaya       = $('#biaya').val();

        // console.log('kode : ', kode);

        $.ajax({
            url: '<?php echo Url::to(['medis-tarif-kamar/update/']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                sk_tarif_id     : sk_tarif_id,
                kamar_id        : kamar_id,
                biaya           : biaya,
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
                    $.pjax.reload('#tarif-kamar #my-gridview', {timeout: 3000});

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
            url: '<?php echo Url::to(['medis-tarif-kamar/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#tarif-kamar #my-gridview', {timeout: 3000});
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
