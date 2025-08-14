<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTarifTindakanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row mt-2">
    <div class="col-md-12">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tindakan_id') ?>

    <?= $form->field($model, 'kelas_rawat_kode') ?>

    <?= $form->field($model, 'sk_tarif_id') ?>

    <?= $form->field($model, 'js_adm') ?>

    <?php // echo $form->field($model, 'js_sarana') ?>

    <?php // echo $form->field($model, 'js_bhp') ?>

    <?php // echo $form->field($model, 'js_dokter_operator') ?>

    <?php // echo $form->field($model, 'js_dokter_lainya') ?>

    <?php // echo $form->field($model, 'js_dokter_anastesi') ?>

    <?php // echo $form->field($model, 'js_penata_anastesi') ?>

    <?php // echo $form->field($model, 'js_paramedis') ?>

    <?php // echo $form->field($model, 'js_lainya') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <!--.col-md-12-->
</div>
