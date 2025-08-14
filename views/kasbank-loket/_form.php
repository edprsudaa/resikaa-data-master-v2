<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KasbankLoket */
/* @var $form yii\bootstrap4\ActiveForm */
?>


<div class="kasbank-loket-form">   

        <?php $form = ActiveForm::begin(['id'=>'form-kasbank']); ?>

        <!-- <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?> -->

        <?= $form->field($model, 'loket_pembayaran')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <label for="exampleInputEmail1">Kelompok Loket</label>
            <div class="row">
                <div class="col"> <?= $form->field($model, 'lkasir')->checkbox(['value' => 1]) ?></div>
                <div class="col"> <?= $form->field($model, 'lregistrasi')->checkbox(['value' => 1]) ?></div>
            </div>           
        </div>


        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
 

</div>
