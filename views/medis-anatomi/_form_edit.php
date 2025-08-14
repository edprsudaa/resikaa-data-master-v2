<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MedisAnatomi */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="medis-anatomi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'parent_id')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($anatomiall, 'id_anatomi', 'rumpun'),
        //'data' =>  ArrayHelper::map($tindakan,'id','deskripsi'),
        'options' => [
            // 'id'=>'Tindakan',
            'placeholder' => 'Pilih Anatomi',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model, 'nama_latin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_indonesia')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label for="exampleInputEmail1">Jenis Kelamin</label>
        <div class="row col-sm-12">
            <div class="col-sm-2"><?= $form->field($model, 'is_lk')->checkbox(['value' => 1]) ?></div>
            <div class="col-sm-2"><?= $form->field($model, 'is_pr')->checkbox(['value' => 1]) ?></div>

        </div>
    </div>

    <?= $form->field($model,'is_active')->widget(Select2::className(),[
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

    <!-- <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-backward"></i> Batal', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
