<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisTarifTindakanUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarif Tindakan Unit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">


    <div class="row">
        <div class="col-md-12">
            <div class="card card-info ">
                <div class="card-header">
                    <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="card-body">
                    <div class="card card-outline card-primary mb-4">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?= Select2::widget([
                                        'name' => 'MedisTarifTindakanUnitKelompok[id]',
                                        'data' => $data_tindakan_unit_parent,
                                        // 'data' => ArrayHelper::map($data_tindakan,'id','deskripsi'),
                                        'options' => [
                                            'id' => 'parent-tindakannya',
                                            // 'onchange' =>'Tampilkan()',
                                            'placeholder' => 'Select Tindakan ...',
                                            'class' => 'form-control-sm',
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                    ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php $url = Url::to(['/medis-tarif-tindakan-unit/tindakan-unit']); ?>
                                    <?= Select2::widget([
                                        'name' => 'MedisTarifTindakanUnit[id]',
                                        'options' => [
                                            'id' => 'tindakannya',
                                            'placeholder' => 'Select Tindakan ...',
                                            'class' => 'form-control-sm',
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'minimumInputLength' => 0,
                                            'ajax' => [
                                                'url' => $url,
                                                'dataType' => 'json',
                                                'delay' => 250,
                                                'data' => new JsExpression('function(params) {
                                                    return {
                                                        q: params.term,
                                                        id_parent: $("#parent-tindakannya").val()
                                                    };
                                                }'),
                                                'processResults' => new JsExpression('function (data) {
                                                    return {
                                                        results: data.results
                                                    };
                                                }'),
                                            ],
                                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new JsExpression('function(data) { return data.text; }'),
                                            'templateSelection' => new JsExpression('function (data) { return data.text; }'),
                                        ],
                                    ]); ?>
                                </div>
                                <div class="col-sm-2">
                                    <?= Select2::widget([
                                        'name' => 'kelasRawat',
                                        'data' => ArrayHelper::map($kelasRawat, 'kode', 'nama'),
                                        'value' => 'all',
                                        'options' => [
                                            'id' => 'kelasId',
                                            'placeholder' => 'Select Kelas Rawat ...',
                                            'class' => 'form-control-sm',
                                        ],
                                        'pluginOptions' => [
                                            // 'tags' => $row,
                                            'allowClear' => true,
                                            // 'multiple' => true
                                        ],
                                    ]);
                                    ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= Select2::widget([
                                        'name' => 'MedisTarifTindakanUnit[unit]',
                                        'data' => ArrayHelper::map($unit_penempatan, 'kode', 'nama'),
                                        'options' => [
                                            'id' => 'unitId',
                                            // 'onchange' =>'TampilkanByUnit()',
                                            'placeholder' => 'Select Unit ...',
                                            'class' => 'form-control-sm'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                    ?>
                                </div>

                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-success btn-save"><i class="fa fa-save"></i> Tambah </button>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="card card-outline card-primary mt-4">
                        <div class="card-body">
                            <?php Pjax::begin(['id' => 'my_pjax']); ?>
                            <div class="row">
                                <div class="col">
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'options' => [
                                            'id' => 'my-gridview'
                                        ],
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            [
                                                'attribute' => 'tarif_tindakan_id',
                                                'headerOptions' => ['style' => 'min-width:350px'],
                                                'value' => function ($model) {
                                                    return $model['tariftindakan']['tindakan']['deskripsi'];
                                                },
                                                // 'filter'    => false,

                                                //  // 'value'     => 'kelasrawat.nama',
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'tarif_tindakan_id',
                                                    'class' => 'form-control-sm',
                                                    'data' => ArrayHelper::map($dataTindakan, 'id', 'rumpun'),
                                                    'options' => [
                                                        'placeholder' => 'Pilih...',
                                                        'class' => 'form-control-sm',
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),


                                            ],
                                            [
                                                'headerOptions' => ['style' => 'min-width:180px'],
                                                'attribute' => 'kelasrawat',
                                                'label' => 'Kelas Rawat',
                                                // 'filter'=>false,
                                                'value' => function ($model) {
                                                    return $model['tariftindakan']['kelasrawat']['nama'];
                                                },

                                                // 'value'     => 'tariftindakan.kelasrawat.nama',
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'kelasrawat',
                                                    'data' => ArrayHelper::map($kelasRawat, 'kode', 'nama'),
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),
                                            ],
                                            //'unit_id',
                                            [
                                                'headerOptions' => ['style' => 'min-width:280px'],
                                                'attribute' => 'unit_id',
                                                'value' => 'unit.nama',
                                                'filter' => Select2::widget([
                                                    'model' => $searchModel,
                                                    'attribute' => 'unit_id',
                                                    'data' => ArrayHelper::map($unit_penempatan, 'kode', 'nama'),
                                                    'options' => [
                                                        'placeholder' => 'Pilih...'
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]),
                                            ],
                                            //'aktif',
                                            [
                                                'attribute' => 'aktif',
                                                'value' => function ($model) {
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
                                            [
                                                'headerOptions' => ['style' => 'min-width:100px'],
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
                                        ],
                                        'layout' => "{summary}\n<div class='table-responsive' style='overflow-x: auto;'>{items}</div>\n{pager}",

                                    ]); ?>
                                </div>
                            </div>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>



                </div>
                <!--.card-body-->
            </div>
        </div>
    </div>
    <!--.row-->
</div>



<!-- delete Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idTarifTindakanUnit">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" id="btnDelete" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="modal-title">Delete Tarif Tindakan Unit</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['medis-tarif-tindakan-unit/hapus'],
                // 'options' => ['id' => 'form-delete']
            ]);
            ?>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="hidden" id="id" name="id">
                        <p>Anda akan menghapus data berikut?</p>
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="update" class="btn btn-danger" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>


    <script>
        $('#delete-modal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var id = button.data('id');
            $('#idTarifTindakanUnit').val(id);
        });


        $('#btnDelete').click(function(e) {
            e.preventDefault();

            var id = $('#idTarifTindakanUnit').val();

            $.ajax({
                url: '<?php echo Url::to(['medis-tarif-tindakan-unit/hapus/']) ?>' + '?id=' + id,
                type: 'post',
                success: function(response) {
                    console.log('response : ', response);

                    if (response.status === 200) {
                        swal.fire({
                            title: response.message,
                            icon: "success"
                        });
                        $('#delete-modal').modal('hide');
                        $.pjax.reload('#my_pjax', {
                            timeout: 3000
                        });

                    } else {
                        swal.fire({
                            title: response.message,
                            icon: "error",
                            // timer   : 3000
                        });
                    }

                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            });

        });


        $('.btn-save').click(function(e) {

            var tindakan_id = $("#tindakannya").val();
            var unit_id = $('#unitId').val();
            var kelas = $('#kelasId').val();
            var parent_id = $('#parent-tindakannya').val();

            if (tindakan_id == "" || unit_id == "" || kelas == "") {
                swal.fire({
                    title: "Harap Pilih Tindakan, Unit, dan Kelas Terlebih Dahulu!",
                    icon: "warning",
                });

                $("#tindakannya").focus();

            } else {
                $.ajax({
                    url: '<?php echo Url::to(['medis-tarif-tindakan-unit/input-data']); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        parent_id: parent_id,
                        tindakan_id: tindakan_id,
                        unit_id: unit_id,
                        kelas: kelas,
                    },
                    success: function(result) {

                        if (result.status === 400) {
                            swal.fire({
                                title: "Maaf, Tindakan medis untuk kelas yang dipilih belum tersedia pada tarif tindakan",
                                icon: "error",
                            });
                        } else {

                            swal.fire({
                                title: "Berhasil Input Tarif Tindakan Unit",
                                icon: "success",
                            });
                            $.pjax.reload('#my_pjax', {
                                timeout: 3000
                            });

                        }


                    },
                    error: function(error) {}
                });
            }
        });
    </script>