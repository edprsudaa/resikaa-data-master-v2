<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KelompokKsmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelompok KSM';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelompok-ksm-index container-fluid">    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Kelompok KSM</h5>
                </div>
                <div class="card-body">
                    <div  class="card-body">   
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-kelompok-ksm',
                            'action' => ['kelompok-ksm/create'],
                            'options' => ['data-pjax' => true]
                        ]); ?>                     
                        
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <input type="text" name="nama" id="kelompokKsm" class="form-control" placeholder="Inputkan Kelompok KSM..." autocomplete="off">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-success btn-flat btn-save">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </span>
                                </div>                                        
                            </div> 
                        </div>
                                        
                        <?php ActiveForm::end(); ?>
                    </div>

                    <div class="card card-outline card-primary mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <?php Pjax::begin(['id' => 'kelompok_ksm_pjax']); ?> 

                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                            'nama',
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
    'title' => 'Ubah Kelompok KSM',
]); ?>
    <form id="form-update-ksm">
        <input type="hidden" id="update-id" name="id">
        <div class="form-group">
            <label for="update-nama">Nama</label>
            <input type="text" class="form-control" id="update-nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="update-aktif">Status</label>
            <select class="form-control" id="update-aktif" name="aktif">
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
$saveUrl = Url::to(['kelompok-ksm/create']);
$updateUrl = Url::to(['kelompok-ksm/update']);
$deleteUrl = Url::to(['kelompok-ksm/delete']);
$js = <<<JS

// Klik tombol simpan
$(document).on('click', '.btn-save', function (e) {
    e.preventDefault();
    
    let form = $(this).closest('form');
    let data = form.serialize();

    let nama = $("#kelompokKsm").val().trim();
    if (nama === "") {
        showToast('warning', 'Harap isi Nama Kelompok KSM terlebih dahulu!');
        $("#kelompokKsm").focus();
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
                $.pjax.reload({container: '#kelompok_ksm_pjax', timeout: 3000});
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
    let nama = $(this).data('nama');
    let aktif = $(this).data('aktif');

    $('#update-id').val(id);
    $('#update-nama').val(nama);
    $('#update-aktif').val(aktif);

    $('#updateModal').modal('show');
});

// Simpan perubahan
$(document).on('click', '#btn-update-save', function (e) {
    e.preventDefault();

    let formData = {
        id: $('#update-id').val(),
        nama: $('#update-nama').val(),
        aktif: $('#update-aktif').val()
    };

    if (!formData.nama) {
        showToast('warning', 'Harap isi Nama Kelompok KSM terlebih dahulu!');
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
                $.pjax.reload({container: '#kelompok_ksm_pjax', timeout: 3000});
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
                        $.pjax.reload('#kelompok_ksm_pjax', { timeout: 3000 });
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

