<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var $model \app\models\emr\pendaftaran\AntrolPengirimanMode */

$this->title = 'Antrol Pengiriman Mode';
$this->params['breadcrumbs'][] = $this->title;

// Ambil nama user dari ID
$updatedBy = $model->updated_by ? $model->pengguna->nama ?? 'Tidak diketahui' : 'Belum ada';
$updatedAt = $model->updated_at ? date('d-m-Y H:i:s', strtotime($model->updated_at)) . ' WIB' : 'Belum ada';
?>

<div class="container mt-4 antrol-pengiriman-mode-index">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
                </div>
                <div class="card-body">

                    <?php Pjax::begin(['id' => 'mode-pjax']); ?>

                    <div class="form-group">
                        <label class="form-label">Mode Pengiriman Langsung</label>
                        <div class="custom-control custom-switch">
                            <?= Html::checkbox('mode-switch', $model->mode == 1, [
                                'class' => 'custom-control-input',
                                'id' => 'mode-switch',
                                'data-id' => $model->id,
                            ]) ?>
                            <label class="custom-control-label" for="mode-switch">
                                <?= $model->mode == 1 ? 'Aktif' : 'Nonaktif' ?>
                            </label>
                        </div>
                    </div>

                    <hr>
                    <p class="text-muted mb-0">
                        <strong>Terakhir diubah:</strong> <?= $updatedAt ?><br>
                        <strong>Diubah oleh:</strong> <?= Html::encode($updatedBy) ?>
                    </p>

                    <?php Pjax::end(); ?>

                </div>
            </div>

        </div>
    </div>
</div>
<?php
$script = <<<JS
function bindSwitchHandler() {
    $('#mode-switch').off('change').on('change', function() {
        let isChecked = $(this).is(':checked') ? 1 : 0;
        let id = $(this).data('id');

        $.ajax({
            url: 'change-mode',
            type: 'POST',
            data: {id: id, mode: isChecked},
            success: function(response) {
                let message = isChecked ? 'Mode pengiriman Langsung telah diaktifkan' : 'Mode pengiriman telah dinonaktifkan';

                if (response.success) {
                    Swal.fire({
                        html: '<h4 style="margin:0">' + message + '</h4>',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        html: '<h4 style="margin:0">Gagal menyimpan!</h4>',
                        icon: 'error'
                    });
                }

                $.pjax.reload({container: '#mode-pjax'});
            },
            error: function() {
                Swal.fire({
                    html: '<h4 style="margin:0">Terjadi kesalahan jaringan!</h4>',
                    icon: 'error'
                });
            }
        });
    });
}

bindSwitchHandler();

$(document).on('pjax:end', function() {
    bindSwitchHandler();
});
JS;
$this->registerJs($script);
?>
