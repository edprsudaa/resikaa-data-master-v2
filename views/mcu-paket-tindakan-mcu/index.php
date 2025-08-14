<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\McuPaketTindakanMcuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paket Tindakan MCU';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <p class="float-sm-right">
                                <?php 
                                    Modal::begin([
                                        'id'    => 'addModal',
                                        'title' => 'Form Tambah Paket Tindakan MCU',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Paket Tindakan MCU', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                   

                    <div class="row">
                        <div class="col-12">
                            <?php Pjax::begin(['id'=>'paket-tindakan-mcu']); ?>
                                <div class="table-responsive">
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,                                    

                                        'columns' => [
                                            [   
                                                'headerOptions'=>['style'=>'min-width:180px'], 
                                                'attribute' => 'kode_paket',
                                                'value'     => function ($model){
                                                    return $model->paket->nama;
                                                },
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'kode_paket',
                                                    'data' => ArrayHelper::map($paket, 'kode', 'nama'),
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),
                                                
                                            ],

                                            [
                                                'attribute'=>'kode_tindakan',
                                            ],
                                            [
                                                'headerOptions'=>['style'=>'min-width:180px'],    
                                                'attribute' => 'kode_unit',
                                                'value' => 'unit.KET',
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'kode_unit',
                                                    'data' => ArrayHelper::map($unit, 'KD_INST', 'KET'),
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),
                                            ],
                                            [
                                                'attribute'=>'nama_tindakan',
                                            ],
                                            [
                                                'attribute'=>'harga',
                                                'value' => function ($model) {
                                                    $harga = number_format($model->harga,0,',','.');
                                                    return 'Rp. ' . $harga;
                                                }
                                            ],
                                            [
                                                'headerOptions'=>['style'=>'min-width:130px'],    
                                                'class' => 'yii\grid\ActionColumn',
                                                'template' => '{delete}',
                                                'buttons' => [
                                                    
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
                                </div> 
                            <?php Pjax::end(); ?>
                        </div>
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
    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#deleteBtn').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['mcu-paket-tindakan-mcu/delete/']) ?>' + '?id=' + id,
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
                   $.pjax.reload('#paket-tindakan-mcu', {timeout:3000});   

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
   
<!-- 
<div class="mcu-paket-tindakan-mcu-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="fa fa-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Mcu Paket Tindakan Mcus','class'=>'btn btn-default']).
                    Html::a('<i class="fa fa-spinner"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Mcu Paket Tindakan Mcus listing',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
            ]
        ])?>
    </div>
</div> -->
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "size" => Modal::SIZE_LARGE,
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
