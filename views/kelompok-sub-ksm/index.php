<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\kelompokSubKsmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelompok Sub KSM';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelompok-sub-ksm-index container-fluid">    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Kelompok Sub KSM</h5>
                </div>
                <div class="card-body">
                    <div  class="card-body">   
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-kelompok-sub-ksm',
                            'action' => ['kelompok-sub-ksm/create'],
                            'options' => ['data-pjax' => true]
                        ]); ?>                     
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <?= Select2::widget([
                                    'name' => 'kelompok_ksm_id',
                                    'id' => 'kelompokKsmId',
                                    'data' => $kelompokKsm,
                                    'options' => [
                                        'placeholder' => 'Pilih Kelompok KSM...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]) ?>
                            </div>

                            <div class="col-md-4">
                                <input type="text" name="nama" id="kelompokSubKsm" class="form-control" placeholder="Inputkan Nama Sub KSM..." autocomplete="off">
                            </div>

                            <div class="col-md-3">
                                <input type="number" name="target_poin" id="targetPoint" class="form-control" placeholder="Target Point" min="0">
                            </div>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-success btn-flat btn-save w-100">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>

                                        
                        <?php ActiveForm::end(); ?>
                    </div>

                    <div class="card card-outline card-primary mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <?php Pjax::begin(['id' => 'kelompok_sub_ksm_pjax']); ?> 

                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                [
                                                    'attribute' => 'kelompok_ksm_id',
                                                    'value' => function ($model) {
                                                        if (!$model->kelompokKsm || $model->kelompokKsm->is_deleted) {
                                                            return '(Tidak tersedia)';
                                                        }
                                                        return $model->kelompokKsm->nama;
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'kelompok_ksm_id',
                                                        'data' => $kelompokKsm,
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                                'nama',
                                                'target_poin',
                                                [
                                                    'attribute'=>'aktif',
                                                    'value' => function ($model){
                                                        $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                                        return $status[$model->aktif] ?? '-';
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
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'template' => '{update}{delete}',
                                                    'buttons' => [
                                                        
                                                        'update' => function($url, $model) {
                                                            return Html::button('<i class="fas fa-pencil-alt"></i>', [
                                                                'class' => 'btn btn-sm btn-default btn-edit mr-2',
                                                                'data-id' => $model->id,
                                                                'data-nama' => $model->nama,
                                                                'data-aktif' => $model->aktif,
                                                                'data-target-poin' => $model->target_poin,
                                                                'title' => 'Ubah Data',
                                                            ]);
                                                        },
                                                    
                                                        'delete' => function ($url, $model) {
                                                            return Html::button('<i class="fa fa-trash"></i>', [
                                                                'class' => 'btn btn-sm btn-danger btn-delete',
                                                                'data-id' => $model->id,
                                                                'title' => 'Hapus'
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
                </div>
            </div>
        </div>
    </div>  
</div>

<?php Modal::begin([
    'id' => 'updateModal',
    'title' => 'Ubah Kelompok Sub KSM',
]); ?>
    <form id="form-update-sub-ksm">
        <input type="hidden" id="update-id" name="id">
        <div class="form-group">
            <label>Kelompok KSM</label>
            <?= Select2::widget([
                'name' => 'kelompok_ksm_id',
                'id' => 'update-kelompok-ksm-id',
                'data' => $kelompokKsm,
                'options' => [
                    'disabled' => true, 
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]) ?>
        </div>
        <div class="form-group">
            <label>Nama Sub KSM</label>
            <input type="text" id="update-nama" class="form-control" placeholder="Masukkan nama sub KSM...">
        </div>

        <div class="form-group">
            <label>Target Poin</label>
            <input type="number" id="update-target-poin" class="form-control" placeholder="Masukkan target poin...">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select id="update-aktif" class="form-control">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
        <div class="form-group text-right">
            <?= Html::button('Simpan', ['class' => 'btn btn-success', 'id' => 'btn-update-save']) ?>
        </div>
    </form>
<?php Modal::end(); ?>


<?php
$saveUrl = Url::to(['kelompok-sub-ksm/create']);
$updateUrl = Url::to(['kelompok-sub-ksm/update']);
$deleteUrl = Url::to(['kelompok-sub-ksm/delete']);
$js = <<<JS

// Klik tombol simpan
$(document).on('click', '.btn-save', function (e) {
    e.preventDefault();
    
    let form = $(this).closest('form');
    let data = form.serialize();
    let kelompokKsmId = $("#kelompokKsmId").val();
    let nama = $("#kelompokSubKsm").val().trim();
    let targetPoint = $("#targetPoint").val().trim();

    // Validasi Kelompok KSM
    if (!kelompokKsmId) {
        showToast('warning', 'Harap pilih Kelompok KSM terlebih dahulu!');
        $("#kelompokKsmId").focus();
        return;
    }

    // Validasi Nama
    if (nama === "") {
        showToast('warning', 'Harap isi Nama Kelompok Sub KSM terlebih dahulu!');
        $("#kelompokSubKsm").focus();
        return;
    }

    // Validasi Target Point (harus angka positif)
    if (targetPoint === "" || isNaN(targetPoint) || parseInt(targetPoint) < 0) {
        showToast('warning', 'Harap isi Target Point dengan angka yang benar!');
        $("#targetPoint").focus();
        return;
    }

    $.ajax({
        url: '$saveUrl',
        type: 'POST',
        data: data,
        success: function (res) {
            if (res.success) {
                showToast('success', 'Data berhasil disimpan!');
                form.trigger("reset");
                $.pjax.reload({container: '#kelompok_sub_ksm_pjax', timeout: 3000});
            } else {
               showToast('error', res.message || "Gagal menyimpan data.");
            }
        },
        error: function (xhr) {
            showToast('error', "Terjadi kesalahan server.");
            console.error(xhr.responseText);
        }
    });
});

$(document).on('click', '.btn-edit', function () {
    let id = $(this).data('id');
    let kelompokKsmId = $(this).data('kelompokKsmId');
    let nama = $(this).data('nama');
    let targetPoin = $(this).data('targetPoin');
    let aktif = $(this).data('aktif');

    $('#update-id').val(id);
    $('#update-nama').val(nama);
    $('#update-aktif').val(aktif);
    $('#update-kelompok-ksm-id').val(kelompokKsmId);
    $('#update-target-poin').val(targetPoin);

    $('#updateModal').modal('show');
});

// Simpan perubahan
$(document).on('click', '#btn-update-save', function (e) {
    e.preventDefault();

    let formData = {
        id: $('#update-id').val(),
        nama: $('#update-nama').val(),
        aktif: $('#update-aktif').val(),
        targetPoin: $('#update-target-poin').val(),
    };

    if (!formData.nama) {
        showToast('warning', 'Harap isi Nama Kelompok Sub KSM terlebih dahulu!');
        $('#update-nama').focus();
        return;
    }

    if (!formData.targetPoin || isNaN(formData.targetPoin)) {
        showToast('warning', 'Harap isi Target Poin dengan angka yang valid!');
        $('#update-target-poin').focus();
        return;
    }

    $.ajax({
        url: '$updateUrl',
        type: 'POST',
        data: formData,
        success: function (res) {
            if (res.success) {
                $('#updateModal').modal('hide');
                showToast('success', res.message || "Data berhasil diperbarui!");
                $.pjax.reload({container: '#kelompok_sub_ksm_pjax', timeout: 3000});
            } else {
                showToast('error', res.message || "Gagal memperbarui data.");
            }
        },
        error: function () {
            showToast('error', 'Terjadi kesalahan server!');
        }
    });
});

// Hapus Data (Soft Delete)
$(document).on('click', '.btn-delete', function () {
    var id = $(this).data('id');

    Swal.fire({
        title: "Yakin ingin menghapus data ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '$deleteUrl',  
                type: 'post',
                data: { id: id },
                success: function (response) {
                    if (response.success) {
                        showToast('success', response.message || "Data berhasil dihapus!");
                        $.pjax.reload('#kelompok_sub_ksm_pjax', { timeout: 3000 });
                    } else {
                        showToast('error', response.message || "Gagal menghapus data!");
                    }
                },
                error: function () {
                    showToast('error', 'Terjadi kesalahan server!');
                }
            });
        }
    });
});

JS;
$this->registerJs($js);

