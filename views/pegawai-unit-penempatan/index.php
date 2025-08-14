<?php

use app\models\UNIT;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PegawaiUnitPenempatan;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiUnitPenempatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unit Penempatan';
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
                                        'title' => 'Form Tambah Unit Penempatan',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Unit Penempatan', 'class' => 'btn btn-success'],
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
                <div class="card-body  p-0">
                    <?php Pjax::begin(['id'=>'unit_penempatan']); ?>
                        <div class="table-responsive">
                        <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'options' => [
                                    'id' => 'my-gridview'
                                ],

                                
                                // 'options' => ['style' => 'font-size:12px;'],
                                'columns' => [
                                    [
                                        'headerOptions'=>['style'=>'min-width:130px'],    
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}{delete}',
                                        'buttons' => [

                                            'update' => function($id, $model) {
                        
                                                return Html::a('<span class="btn btn-sm btn-warning mr-2"><b class="fa fa-pen"></b></span>', null,
                                                [
                                                    'title' => 'Ubah',
                                                    'data' => [
                                                        'toggle'    => 'modal',
                                                        'target'    => '#editModal',
                                                        'id'        => $model->kode, 
                                                    ],
                                                ]);
                                            },
                                           
                                            
                                            'delete' => function ($id, $model) {
                                                return Html::button('<b class="fa fa-trash"></b>', [
                                                    'class' => 'btn btn-sm btn-danger',
                                                    'data'  => [
                                                        'toggle'    => 'modal',
                                                        'target'    => '#delete-modal',
                                                        'id'        => $model->kode
                                                    ],
                                                ]);
                                            },
                                        ]
                                    ],
                                    // ['class' => 'yii\grid\SerialColumn'],
                                    
                                    'kode',
                                
                                    [
                                        'headerOptions'=>['style'=>'min-width:170px'],    
                                        'attribute' => 'unit_rumpun',
                                        'value'     => function ($model){
                                            return $model->unitRumpun->nama;
                                        },
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'unit_rumpun',
                                            'data' => ArrayHelper::map($unit_rumpun, 'kode', 'nama'),
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],

                                
                               
                                    [
                                    'headerOptions'=>['style'=>'min-width:170px'],  
                                        'attribute' => 'nama',
                                        'value'     => function ($model){
                                            return $model->nama;
                                        },
                                        // 'filter' => Select2::widget([
                                        //     'model' => $searchModel,
                                        //     'attribute' => 'nama',
                                        //     'data' => ArrayHelper::map($unit_rumpun, 'kode', 'nama'),
                                        //     'options' => [
                                        //         'placeholder' => 'Pilih...'
                                        //     ],
                                        //     'pluginOptions' => [
                                        //         'allowClear' => true
                                        //     ],
                                        // ]),
                                    ],
                                    // 'unit_rumpun',

                                    [
                                        'headerOptions'=>['style'=>'min-width:100px'],  
                                        'attribute'=>'kode_unitsub_maping_simrs',
                                        'value' => function ($model){
                                            // $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $model->kode_unitsub_maping_simrs == null ? '-' : $model->kode_unitsub_maping_simrs ;
                                        },
                                    ],
                              
                                // 'kode_unitsub_maping_simrs',
                                    [
                                        'attribute'=>'is_igd',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_igd];
                                        },
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_igd',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_rj',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_rj];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_rj',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_ri',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_ri];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_ri',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_lab_pa',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_lab_pa];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_lab_pa',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_lab_pk',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_lab_pk];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_lab_pk',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_lab_bio',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_lab_bio];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_lab_bio',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_radiologi',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_radiologi];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_radiologi',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_radioterapi',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_radioterapi];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_radioterapi',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_ok',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_ok];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_ok',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_hd',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_hd];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_hd',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_rehab_medik',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_rehab_medik];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_rehab_medik',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute'=>'is_penunjang',
                                        'value' => function ($model){
                                            $status = [0 => 'Tidak', 1 => 'Ya'];
                                            return $status[$model->is_penunjang];
                                        },
                                         'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'is_penunjang',
                                            'data' => [1 => 'Ya', 0 => 'Tidak'],
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

                                
                                ],
                                'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                                'pager' => [
                                    'class' => 'yii\bootstrap4\LinkPager',
                                ]
                            ]); ?>
                                </div> 
                            </div>
                        </div>
                    <?php Pjax::end(); ?>
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

<!-- detail Modal -->
<div class="modal fade" id="detailPenempatan" tabindex="-1" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Detail Unit Penempatann</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'detail-penempatan']); ?> 

            
            <div class="modal-body">
                <div class="row">   
                    <div class="col">
                        <!-- <div class="card"> -->
                            <div class="card-body">
                                <div class="invoice p-3 mb-3">  
                                    <div class="row invoice-info mb-4">
                                        <div class="col-sm-4 invoice-col">
                                            Nama Unit :
                                            <address>
                                                <strong id="nama_unit"></strong>
                                            </address>
                                        </div>
                                        <!-- <div class="col-sm-4 invoice-col">
                                            Unit Rumpun :
                                            <address>
                                                <strong id="unit_rumpun"></strong>
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            Unit Sub Maping RS :
                                            <address>
                                                <strong id="unit_maping"></strong>
                                            </address>
                                        </div> -->
                                    </div>

                                    <div class="card-header">
                                        <h3 class="card-title">Kelompok Layanan</h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-4">
                                            <thead>
                                                <tr style="text-align:center">
                                                    <th>IGD</th>
                                                    <th>RAWAT JALAN</th>
                                                    <th>RAWAT INAP</th>
                                                    <th>LAB_PA</th>
                                                    <th>LAB_PK</th>
                                                    <th>RADIOLOGI</th>
                                                    <th>OK</th>
                                                    <th>HD</th>
                                                    <th>LAB_BIO</th>
                                                    <th>R. TERAPI</th>
                                                    <th>REHAB MEDIK</th>
                                                    <th>PENUNJANG</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="text-align:center">
                                                    <td id="igd"></td>
                                                    <td id="rj"></td>
                                                    <td id="ri"></td>
                                                    <td id="lab_pa"></td>
                                                    <td id="lab_pk"></td>
                                                    <td id="radiologi"></td>
                                                    <td id="ok"></td>
                                                    <td id="hd"></td>
                                                    <td id="lab_bio"></td>
                                                    <td id="radioterapi"></td>
                                                    <td id="rehab_medik"></td>
                                                    <td id="penunjang"></td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Unit Penempatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php 
                $unit_rumpun = PegawaiUnitPenempatan::find()->orderBy(['kode'=> SORT_ASC])->all();
                $unit = UNIT::find()->orderBy(['KET' => SORT_ASC])->all();
            ?>
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <?php $form = ActiveForm::begin(['id'=> 'form-unit-penempatan','options' => ['data-pjax' => true ]]); ?>
                            <input type="hidden" name="id" name="id">
                            <?= $form->field($model,'unit_rumpun')->widget(Select2::className(),[
                                    'data' =>  ArrayHelper::map($unit_rumpun,'kode','nama'),
                                    'options' => [
                                        'id'=>'unit_rumpun_id',
                                        'placeholder' => '== Pilih Group Organisasi ==',
                                        'class'=>'form-control-sm',
                                        'disabled'=>true
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) 
                            ?>

                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama']) ?>

                            <?= $form->field($model,'kode_unitsub_maping_simrs')->widget(Select2::className(),[
                                    'data' =>  ArrayHelper::map($unit,'KD_INST','KET'),
                                    'options' => [
                                        'id'=>'kode_unitsub_maping',
                                        'placeholder' => '== Pilih Unit Maping ==',
                                        'class'=>'form-control-sm'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->hint('*ABAIKAN JIKA TIDAK ADA UNIT MAPING') 
                            ?>
                            

                            <div class="form-group">
                                <label for="exampleInputEmail1">Kelompok Layanan</label>
                                <div class="row">
                                    <div class="col"><?= $form->field($model, 'is_igd')->checkbox([ 'id' => 'is_igdd']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_rj')->checkbox(['id' => 'is_rj']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_ri')->checkbox([ 'id' => 'is_ri']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_lab_pa')->checkbox([ 'id' => 'is_lab_pa']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_lab_pk')->checkbox([ 'id' => 'is_lab_pk']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_radiologi')->checkbox(['id' => 'is_radiologi']) ?></div>
                                </div>
                                <div class="row">
                                    <div class="col"><?= $form->field($model, 'is_ok')->checkbox([ 'id' => 'is_ok']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_hd')->checkbox([ 'id' => 'is_hd']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_lab_bio')->checkbox([ 'id' => 'is_lab_bio']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_radioterapi')->checkbox([ 'id' => 'is_radioterapi']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_rehab_medik')->checkbox([ 'id' => 'is_rehab_medik']) ?></div>
                                    <div class="col"><?= $form->field($model, 'is_penunjang')->checkbox([ 'id' => 'is_penunjang']) ?></div>
                                </div>
                            </div>

                            <?= 
                                $form->field($model, 'aktif')->widget(Select2::classname(), [
                                    'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                                    'options' => ['placeholder' => 'Pilih...', 'id'=>'aktif'],
                                    ])->label('Status'); 
                            ?>
            
                            <div class="form-group float-sm-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" id="btnEdit" class="btn btn-primary" autocomplete="off">Simpan</button>
                            </div>

                             <?php ActiveForm::end(); ?>
                        </div>
                    </div>  
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
            url: '<?php echo Url::to(['pegawai-unit-penempatan/delete/']) ?>' + '?id=' + id,
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
                    $.pjax.reload('#unit_penempatan #my-gridview', {timeout: 3000});
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

    $('#detailPenempatan').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id'); 

        $.ajax({
            url: '<?php echo Url::to(['pegawai-unit-penempatan/view/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                console.log('response : ', response.success);
                console.log('data : ', response.data);

                if (response.success === true) {       
                    var nama_unit = response.data.nama;           
                    var igd = response.data.is_igd;
                    var rj = response.data.is_rj;
                    var ri = response.data.is_ri;
                    var lab_pa = response.data.is_lab_pa;
                    var lab_pk = response.data.is_lab_pk;
                    var radiologi = response.data.is_radiologi;
                    var radioterapi = response.data.is_radioterapi;
                    var rehab_medik = response.data.is_rehab_medik;
                    var penunjang = response.data.is_penunjang;
                    var ok = response.data.is_ok;
                    var hd = response.data.is_hd;
                    var lab_bio = response.data.is_lab_bio;

                    $('#nama_unit').html(nama_unit);

                    $('#igd').html(igd == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#rj').html(rj == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#ri').html(ri == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#lab_pa').html(lab_pa == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#lab_pk').html(lab_pk == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#radiologi').html(radiologi == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#radioterapi').html(radioterapi == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#rehab_medik').html(rehab_medik == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#penunjang').html(penunjang == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#ok').html(ok == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#hd').html(hd == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');
                    $('#lab_bio').html(lab_bio == 1 ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>');


                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Terjadi kesalahan saat Mengambil data. Status: ' + textStatus + ' Error: ' + errorThrown);
            }
        });    

       

    });

    $('#editModal').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id'); 

        $.ajax({
            url: '<?php echo Url::to(['pegawai-unit-penempatan/view/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                console.log('response : ', response.success);
                console.log('data : ', response.data);

                if (response.success === true) {      
                    var id = response.data.kode;
                    var aktif = response.data.aktif;
                    var unit_rumpun = response.data.unit_rumpun; 
                    var nama_unit = response.data.nama;           
                    var kode_unitsub_maping = response.data.kode_unitsub_maping_simrs;           
                    var igd = response.data.is_igd;
                    var rj = response.data.is_rj;
                    var ri = response.data.is_ri;
                    var lab_pa = response.data.is_lab_pa;
                    var lab_pk = response.data.is_lab_pk;
                    var radiologi = response.data.is_radiologi;
                    var radioterapi = response.data.is_radioterapi;
                    var rehab_medik = response.data.is_rehab_medik;
                    var penunjang = response.data.is_penunjang;
                    var ok = response.data.is_ok;
                    var hd = response.data.is_hd;
                    var lab_bio = response.data.is_lab_bio;

                   

                    

                    $('#id').val(id);
                    $('#aktif').val(aktif).trigger('change');
                    $('#unit_rumpun_id').val(unit_rumpun).trigger('change');
                    $('#kode_unitsub_maping').val(kode_unitsub_maping).trigger('change');
                    $('#nama').val(nama_unit);
                    $('#is_igdd').prop('checked', igd == 1 ? true : false);
                    $('#is_rj').prop('checked', rj == 1 ? true : false);
                    $('#is_ri').prop('checked', ri == 1 ? true : false);
                    $('#is_lab_pa').prop('checked', lab_pa == 1 ? true : false);
                    $('#is_lab_pk').prop('checked', lab_pk == 1 ? true : false);
                    $('#is_radiologi').prop('checked', radiologi == 1 ? true : false);
                    $('#is_ok').prop('checked', ok == 1 ? true : false);
                    $('#is_hd').prop('checked', hd == 1 ? true : false);
                    $('#is_lab_bio').prop('checked', lab_bio == 1 ? true : false);
                    $('#is_radioterapi').prop('checked', radioterapi == 1 ? true : false);
                    $('#is_rehab_medik').prop('checked', rehab_medik == 1 ? true : false);
                    $('#is_penunjang').prop('checked', penunjang == 1 ? true : false);                   


                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Terjadi kesalahan saat Mengambil data. Status: ' + textStatus + ' Error: ' + errorThrown);
            }
        });    

       

    });

    $('#btnEdit').click(function(e) {
        e.preventDefault();

        var id       = $('#id').val();
        var nama     = $('#nama').val();
        var unit_rumpun = $('#unit_rumpun_id').val();
        var kode_unitsub_maping  = $('#kode_unitsub_maping').val();
        var aktif     = $('#aktif').val();
        var is_igd = document.getElementById('is_igdd').checked == false ? 0 : 1;
        var is_rj = document.getElementById('is_rj').checked == false ? 0 : 1;
        var is_ri = document.getElementById('is_ri').checked == false ? 0 : 1;
        var is_lab_pa = document.getElementById('is_lab_pa').checked == false ? 0 : 1;
        var is_lab_pk = document.getElementById('is_lab_pk').checked == false ? 0 : 1;
        var is_radiologi = document.getElementById('is_radiologi').checked == false ? 0 : 1;
        var is_ok = document.getElementById('is_ok').checked == false ? 0 : 1;
        var is_hd = document.getElementById('is_hd').checked == false ? 0 : 1;
        var is_lab_bio = document.getElementById('is_lab_bio').checked == false ? 0 : 1;
        var is_radioterapi = document.getElementById('is_radioterapi').checked == false ? 0 : 1;
        var is_rehab_medik = document.getElementById('is_rehab_medik').checked == false ? 0 : 1;
        var is_penunjang = document.getElementById('is_penunjang').checked == false ? 0 : 1;
           
        // console.log('kode : ', kode);

        $.ajax({
            url: '<?php echo Url::to(['pegawai-unit-penempatan/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                nama : nama,
                unit_rumpun: unit_rumpun,
                kode_unitsub_maping : kode_unitsub_maping,
                aktif   : aktif,
                is_igd : is_igd,
                is_rj  : is_rj,
                is_ri  : is_ri,
                is_lab_pa : is_lab_pa,
                is_lab_pk : is_lab_pk,
                is_radiologi : is_radiologi,
                is_ok  : is_ok,
                is_hd  : is_hd,
                is_lab_bio : is_lab_bio,
                is_rehab_medik : is_rehab_medik,
                is_radioterapi : is_radioterapi,
                is_penunjang : is_penunjang,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    document.getElementById("form-unit-penempatan").reset();
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#unit_penempatan', {timeout: 3000});

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
