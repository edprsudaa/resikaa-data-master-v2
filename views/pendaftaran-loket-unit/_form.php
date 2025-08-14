<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranLoketUnit */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="pendaftaran-loket-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'loket_kode')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($loket,'kode','nama'),
        'options' => [
            'placeholder' => 'Pilih Loket',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model,'unit_id')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($unit,'kode','nama'),
        'options' => [
            'placeholder' => 'Pilih Unit',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model,'aktif')->widget(Select2::className(),[
        'data' =>  ['' => 'Pilih Status','1' => 'Aktif','0' => 'Tidak Aktif'],
        'options' => [
            'placeholder' => 'Pilih Status',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
