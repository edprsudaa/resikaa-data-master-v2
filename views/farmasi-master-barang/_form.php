<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiMasterBarang */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="farmasi-master-barang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->checkbox() ?>

    <?= $form->field($model, 'deleted_by')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'riwayat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kode_barang')->textInput() ?>

    <?= $form->field($model, 'nama_barang')->textInput() ?>

    <?= $form->field($model, 'nama_generik')->textInput() ?>

    <?= $form->field($model, 'id_satuan')->textInput() ?>

    <?= $form->field($model, 'id_kemasan')->textInput() ?>

    <?= $form->field($model, 'tipe_barang')->textInput() ?>

    <?= $form->field($model, 'id_kelompok')->textInput() ?>

    <?= $form->field($model, 'id_jenis')->textInput() ?>

    <?= $form->field($model, 'id_sub_jenis')->textInput() ?>

    <?= $form->field($model, 'id_golongan')->textInput() ?>

    <?= $form->field($model, 'id_klasifikasi')->textInput() ?>

    <?= $form->field($model, 'retriksi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isi_per_kemasan')->textInput() ?>

    <?= $form->field($model, 'harga_kemasan')->textInput() ?>

    <?= $form->field($model, 'harga_satuan_terakhir')->textInput() ?>

    <?= $form->field($model, 'harga_satuan_tertinggi')->textInput() ?>

    <?= $form->field($model, 'is_ppn')->checkbox() ?>

    <?= $form->field($model, 'total_ppn')->textInput() ?>

    <?= $form->field($model, 'diskon_persen')->textInput() ?>

    <?= $form->field($model, 'stok_max')->textInput() ?>

    <?= $form->field($model, 'stok_min')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
