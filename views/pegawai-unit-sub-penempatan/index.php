<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use app\components\Helper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PegawaiUnitPenempatan;
use app\models\PegawaiUnitSubPenempatan;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiUnitSubPenempatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jabatan / Penempatan';
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
                                        'title' => 'Form Tambah Jabatan / Penempatan',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Jabatan / Penempatan', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>
                    </div>
                  


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?php Pjax::begin(['id'=>'jabatan']); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'options' => [
                                'id' => 'my-gridview'
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                            //    'kode',
                            'nama:ntext',
                             [
                                    'attribute'=>'kode_rumpun',
                                    'value' => function ($model) {
                                        $v = Helper::getUnitSubPenempatan($model->kode_rumpun);
                                        return $v;
                                    },
                                    'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute'=>'kode_rumpun',
                                        'data' => ArrayHelper::map($atasan, 'kode', 'nama'),
                                        'options' => [
                                            'placeholder' => 'Pilih...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]),
                                ],
                            [
                                    'attribute'=>'kode_group',
                                    'value' => function ($model) {
                                    $v = Helper::getUnitPenempatan($model->kode_group);
                                    return $v;
                                    },                   
                                    'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute'=>'kode_group',
                                        'data' => ArrayHelper::map($unit, 'kode', 'nama'),
                                        'options' => [
                                            'placeholder' => 'Pilih...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]),
                                ],

                                
                               
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
                                'headerOptions'=>['style'=>'min-width:160px'],    
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
                                                'nama'    => $model->nama,
                                                'kode_rumpun'  => $model->kode_rumpun,  
                                                'kode_group'  => $model->kode_group,  
                                                'aktif'  => $model->aktif,  
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
                <h5 class="modal-title">Form Edit Jabatan / Penempatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php 
                $form = ActiveForm::begin(['id'=>'form-edit']); 
                $unit = PegawaiUnitPenempatan::find()->orderBy(['kode'=>SORT_ASC])->all();
                $atasan = PegawaiUnitSubPenempatan::find()->orderBy(['kode'=>SORT_ASC])->all();
                // $jenisPendidikan = PegawaiJurusan::getAllJenisPendidikan();              
            ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <input type="hidden" name="kode" id="kode">

                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama']) ?>

                             <?= $form->field($model, 'kode_rumpun')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map($atasan, 'kode', 'nama'),
                                    'options' => [
                                        'placeholder' => 'Pilih...',
                                        'id' => 'kode_rumpun_edit',
                                    ],
                                ]); 
                            ?>

                            <?= $form->field($model, 'kode_group')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map($unit, 'kode', 'nama'),
                                    'options' => [
                                        'placeholder' => 'Pilih...',
                                        'id' => 'kode_group_edit',
                                    ],
                                ]); 
                            ?>

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

<script>
    $('#editModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var kode =  button.data('kode');
        var kode_group =  button.data('kode_group');
        var kode_rumpun =  button.data('kode_rumpun');
        var nama =  button.data('nama');
        var aktif =  button.data('aktif');

        $('#kode').val(kode);     
        $('#nama').val(nama);
        $('#aktif').val(aktif).trigger('change');
        $('#kode_rumpun_edit').val(kode_rumpun).trigger('change');
        $('#kode_group_edit').val(kode_group).trigger('change');
    }); 


    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var kode  = $('#kode').val();
        var nama     = $('#nama').val();
        var kode_group     = $('#kode_group_edit').val();
        var kode_rumpun  = $('#kode_rumpun_edit').val();
        var aktif  = $('#aktif').val();


        $.ajax({
            url: '<?php echo Url::to(['pegawai-unit-sub-penempatan/update/']) ?>' + '?id=' + kode,
            type: 'post',          
            data: {
                kode     : kode,
                nama       : nama,
                aktif       : aktif,
                kode_group       : kode_group,
                kode_rumpun       : kode_rumpun,
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
                    $.pjax.reload('#jabatan #my-gridview', {timeout: 3000});

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
