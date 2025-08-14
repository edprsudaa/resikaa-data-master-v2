<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PegawaiUnitPenempatan;

/* @var $this yii\web\View */
/* @var $model app\models\MappingPoliBpjs */
/* @var $form yii\widgets\ActiveForm */

$unit_penempatan = PegawaiUnitPenempatan::find()
      ->where(['aktif' => 1])       
        ->orderBy(['nama' => SORT_ASC])
        ->asArray()
        ->all();   


?>

<div class="mapping-poli-bpjs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bpjs_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bpjs_nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bpjs_sub_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bpjs_sub_nama')->textInput() ?>

    <!-- <?= $form->field($model, 'simrs_kode')->textInput() ?> -->
    <?= $form->field($model, 'simrs_kode')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($unit_penempatan, 'kode', 'nama'),
            'options' => ['placeholder' => 'Pilih Poli...'],
            'pluginOptions' => [ 
                'allowClear' => false,
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
