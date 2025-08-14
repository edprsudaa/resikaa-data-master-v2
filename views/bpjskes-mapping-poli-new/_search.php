<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BpjskesMappingPoliNewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bpjskes-mapping-poli-new-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bpjs_kode') ?>

    <?= $form->field($model, 'bpjs_nama') ?>

    <?= $form->field($model, 'bpjs_sub_kode') ?>

    <?= $form->field($model, 'bpjs_sub_nama') ?>

    <?php // echo $form->field($model, 'simrs_kode') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
