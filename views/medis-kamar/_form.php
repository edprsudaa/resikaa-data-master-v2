<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MedisKamar */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="medis-kamar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'unit_id')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($unit,'kode','nama'),
            'options' => [
                'id'=>'KodeUnit',
                'placeholder' => 'Pilih Unit',
                'class'=>'form-control-sm'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) 
    ?>

    <?= $form->field($model,'kelas_rawat_kode')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($kelas_rawat,'kode','nama'),
        'options' => [
            'id'=>'KelasRawat',
            'placeholder' => 'Pilih Kelas Rawat',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model, 'no_kamar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_kasur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'aktif')->widget(Select2::className(),[
        'data' =>  ['' => 'Pilih Status','1' => 'Aktif','0' => 'Tidak Aktif'],
        'options' => [
            'id'=>'Status',
            'placeholder' => 'Pilih Status',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>
<!-- 
    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-backward"></i> Batal', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
