<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\components\HelperSpesial;

$this->title = 'Pegawai Ksm Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-ksm-detail-index container-fluid">    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Pegawai Ksm Detail</h5>
                </div>
                <div class="card-body">
                    <div  class="card-body">   
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-pegawai-ksm-detail',
                            'action' => ['pegawai-ksm-detail/create'],
                            'options' => ['data-pjax' => true]
                        ]); ?>                     
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <?= Select2::widget([
                                    'name' => 'pegawai_id',
                                    'id' => 'pegawaiId',
                                    'data' => HelperSpesial::getListDokter(false, true, true),
                                    'options' => [
                                        'placeholder' => 'Pilih Dokter KSM...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]) ?>
                                <small class="form-text text-muted">
                                    *Dokter yang sudah terdaftar di KSM aktif (lihat tabel di bawah) tidak akan muncul di pilihan.
                                </small>
                            </div>

                            <div class="col-md-2">
                                <?= Select2::widget([
                                    'name' => 'kelompok_ksm_id',
                                    'id' => 'kelompokKsmId',
                                    'data' => $kelompokKsmList,
                                    'options' => [
                                        'placeholder' => 'Pilih Kelompok KSM...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]) ?>
                            </div>

                            <div class="col-md-3">
                                <?= Select2::widget([
                                    'name' => 'kelompok_sub_ksm_id',
                                    'id' => 'kelompokSubKsm',
                                    // 'data' => $dokterList,
                                    'options' => [
                                        'placeholder' => 'Pilih Sub KSM...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]) ?>
                            </div>

                            <div class="col-md-2">
                                <?= Select2::widget([
                                    'name' => 'kategori_dokter_id',
                                    'id' => 'kategoriDokterId',
                                    'data' => $kategoriDokterList,
                                    'options' => [
                                        'placeholder' => 'Pilih Kategori Dokter...',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]) ?>
                            </div>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-success btn-flat btn-save w-100">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-warning btn-flat w-100" onclick="location.reload();">
                                    <i class="fa fa-sync"></i> Refresh
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
                                        <?php Pjax::begin(['id' => 'pegawai_ksm_detail_pjax']); ?> 

                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                [
                                                    'attribute' => 'pegawai_id',
                                                    'value' => function ($model) {
                                                        if (!$model->pegawai) {
                                                            return '(Tidak tersedia)';
                                                        }
                                                        return HelperSpesial::getNamaPegawai($model->pegawai) ?? '(Tidak tersedia)';
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'pegawai_id',
                                                        'data' => HelperSpesial::getListDokter(false, true),
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
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
                                                        'data' => $kelompokKsmList,
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                                [
                                                    'attribute' => 'kelompok_sub_ksm_id',
                                                    'value' => function ($model) {
                                                        return $model->kelompokSubKsm ? $model->kelompokSubKsm->nama : '(Tidak tersedia)';
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'kelompok_sub_ksm_id',
                                                        'data' => $kelompokSubKsmList,
                                                        'options' => [
                                                            'placeholder' => 'Pilih...'
                                                        ],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]),
                                                ],
                                                [
                                                    'attribute' => 'kategori_dokter_id',
                                                    'value' => function ($model) {
                                                        return $model->kategoriDokter ? $model->kategoriDokter->nama : '(Tidak tersedia)';
                                                    },
                                                    'filter' => Select2::widget([
                                                        'model' => $searchModel,
                                                        'attribute' => 'kategori_dokter_id',
                                                        'data' => $kategoriDokterList,
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
                                                                'data-aktif' => $model->aktif,
                                                                'data-pegawai-id' => $model->pegawai_id,
                                                                'data-kelompok-ksm-id' => $model->kelompokSubKsm->kelompokKsm->id ?? '',                   
                                                                'data-kelompok-sub-ksm-id' => $model->kelompok_sub_ksm_id,   
                                                                'data-kategori-dokter-id' => $model->kategori_dokter_id,                                   
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
    'title' => 'Ubah Pegawai KSM Detail',
]); ?>
    <form id="form-update-pegawai-ksm">
        <input type="hidden" id="update-id" name="id">

        <div class="form-group">
            <label>Dokter KSM</label>
            <?= Select2::widget([
                'name' => 'pegawai_id',
                'id' => 'update-pegawai-id',
                'data' => HelperSpesial::getListDokter(false, true),
                'options' => [
                    'placeholder' => 'Pilih Dokter...',
                    'disabled' => true, // tidak boleh ubah pegawai
                ],
                'pluginOptions' => [
                    'allowClear' => false,
                ],
            ]) ?>
        </div>

        <div class="form-group">
            <label>Kelompok KSM</label>
            <?= Select2::widget([
                'name' => 'kelompok_ksm_id',
                'id' => 'update-kelompok-ksm-id',
                'data' => $kelompokKsmList ?? [],
                'pluginOptions' => [
                    'allowClear' => false,
                ],
            ]) ?>
        </div>

        <div class="form-group">
            <label>Sub Kelompok KSM</label>
            <?= Select2::widget([
                'name' => 'kelompok_sub_ksm_id',
                'id' => 'update-kelompok-sub-ksm-id',
                'data' =>  $kelompokSubKsmList ?? [],
                'pluginOptions' => [
                    'allowClear' => false,
                ],
            ]) ?>
        </div>

        <div class="form-group">
            <label>Kategori Dokter</label>
            <?= Select2::widget([
                'name' => 'kategori_dokter_id',
                'id' => 'update-kategori-dokter-id',
                'data' => $kategoriDokterList ?? [],
                'options' => [
                    'placeholder' => 'Pilih Kategori Dokter...',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) ?>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select id="update-aktif" name="aktif" class="form-control">
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
$saveUrl = Url::to(['pegawai-ksm-detail/create']);
$updateUrl = Url::to(['pegawai-ksm-detail/update']);
$deleteUrl = Url::to(['pegawai-ksm-detail/delete']);
$getSubKsmUrl = Url::to(['pegawai-ksm-detail/get-sub-ksm']);
$js = <<<JS


$('#kelompokKsmId').on('change', function() {
    let ksmId = $(this).val();
    let subKsm = $('#kelompokSubKsm');
    if (ksmId) {
        $.ajax({
            url: '$getSubKsmUrl',
            data: { ksm_id: ksmId },
            success: function(data) {
                subKsm.empty();
                let defaultOption = new Option('Pilih Sub', '', true, true);
                subKsm.append(defaultOption);
                $.each(data, function(id, text) {
                    let newOption = new Option(text, id, false, false);
                    subKsm.append(newOption);
                });
                subKsm.trigger('change');
            }
        });
    } else {
        subKsm.empty().trigger('change');
    }
});

$('#update-kelompok-ksm-id').on('change', function () {
    let ksmId = $(this).val();
    let subKsm = $('#update-kelompok-sub-ksm-id');
    if (ksmId) {
        $.ajax({
            url: '$getSubKsmUrl', 
            data: { ksm_id: ksmId },
            success: function (data) {
                subKsm.empty();
                let defaultOption = new Option('Pilih Sub', '', true, true);
                subKsm.append(defaultOption);
                $.each(data, function (id, text) {
                    let newOption = new Option(text, id, false, false);
                    subKsm.append(newOption);
                });
                subKsm.trigger('change');
            }
        });
    } else {
        subKsm.empty().trigger('change');
    }
});


// Klik tombol simpan
$(document).on('click', '.btn-save', function (e) {
    e.preventDefault();
    
    let form = $(this).closest('form');
    let data = form.serialize();
    
    let pegawaiId = $("#pegawaiId").val();
    let kelompokKsmId = $("#kelompokKsmId").val();
    let kelompokSubKsmId = $("#kelompokSubKsm").val();
    let kategoriDokterId = $("#kategoriDokterId").val();

   // Validasi Pegawai/Dokter
    if (!pegawaiId) {
        showToast('warning', 'Harap pilih Dokter KSM terlebih dahulu!');
        $("#pegawaiId").focus();
        return;
    }

    // Validasi Kelompok KSM
    if (!kelompokKsmId) {
        showToast('warning', 'Harap pilih Kelompok KSM terlebih dahulu!');
        $("#kelompokKsmId").focus();
        return;
    }

    // Validasi Sub KSM
    if (!kelompokSubKsmId) {
        showToast('warning', 'Harap pilih Sub KSM terlebih dahulu!');
        $("#kelompokSubKsm").focus();
        return;
    }

    // Validasi Kategori Dokter
    if (!kategoriDokterId) {
        showToast('warning', 'Harap pilih Kategori Dokter terlebih dahulu!');
        $("#kategoriDokterId").focus();
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
                // Reset Select2
                $("#pegawaiId").val('').trigger('change');
                $("#kelompokKsmId").val('').trigger('change');
                $("#kelompokSubKsm").val('').trigger('change');
                $("#kategoriDokterId").val('').trigger('change');
                
                $.pjax.reload({container: '#pegawai_ksm_detail_pjax', timeout: 3000});
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
    let ksmId = $(this).data('kelompok-ksm-id');
    let subKsmId = $(this).data('kelompok-sub-ksm-id');

    $('#update-id').val($(this).data('id'));
    $('#update-aktif').val($(this).data('aktif'));
    $('#update-pegawai-id').val($(this).data('pegawai-id')).trigger('change');
    $('#update-kelompok-ksm-id').val(ksmId).trigger('change');

    // Load sub KSM sesuai data lama
    if (ksmId) {
        $.ajax({
            url: '$getSubKsmUrl',
            data: { ksm_id: ksmId },
            success: function(data) {
                let subKsm = $('#update-kelompok-sub-ksm-id');
                subKsm.empty();
                let defaultOption = new Option('Pilih Sub', '', false, false);
                subKsm.append(defaultOption);
                $.each(data, function(id, text) {
                    let selected = (id == subKsmId);
                    let newOption = new Option(text, id, selected, selected);
                    subKsm.append(newOption);
                });
                subKsm.trigger('change');
            }
        });
    }

    $('#update-kategori-dokter-id').val($(this).data('kategori-dokter-id')).trigger('change');
    $('#updateModal').modal('show');
});


// Simpan perubahan
$(document).on('click', '#btn-update-save', function (e) {
    e.preventDefault();

    let formData = {
        id: $('#update-id').val(),
        pegawai_id: $('#update-pegawai-id').val(),
        aktif: $('#update-aktif').val(),
        kelompok_ksm_id: $('#update-kelompok-ksm-id').val(),
        kelompok_sub_ksm_id: $('#update-kelompok-sub-ksm-id').val(),
        kategori_dokter_id: $('#update-kategori-dokter-id').val(),
    };

    if (!formData.pegawai_id) {
        showToast('warning', 'Harap pilih Dokter KSM terlebih dahulu!');
        return;
    }
    if (!formData.kelompok_ksm_id) {
        showToast('warning', 'Harap pilih Kelompok KSM terlebih dahulu!');
        return;
    }
    if (!formData.kelompok_sub_ksm_id) {
        showToast('warning', 'Harap pilih Sub KSM terlebih dahulu!');
        return;
    }
    if (!formData.kategori_dokter_id) {
        showToast('warning', 'Harap pilih Kategori Dokter terlebih dahulu!');
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
                $.pjax.reload({container: '#pegawai_ksm_detail_pjax', timeout: 3000});
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
                        $.pjax.reload('#pegawai_ksm_detail_pjax', { timeout: 3000 });
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

