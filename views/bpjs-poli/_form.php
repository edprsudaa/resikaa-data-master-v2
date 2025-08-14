<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BpjsPoli */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="bpjs-poli-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'poli_bpjs_id')->textInput() ?>

    <?= $form->field($model, 'poli_bpjs_nama')->textInput() ?>

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
