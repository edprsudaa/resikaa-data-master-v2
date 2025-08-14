<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTarifKamar */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="medis-tarif-kamar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'kamar_id')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($kamar,'kode','name'),
        'options' => [
            'id'=>'Kamar',
            'placeholder' => 'Pilih Kamar',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model,'sk_tarif_id')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($sk_tarif,'id','nomor'),
        'options' => [
            'id'=>'SKTarif',
            'placeholder' => 'Pilih SK Tarif',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model, 'biaya')->textInput() ?>

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
