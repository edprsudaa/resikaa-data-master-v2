<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AplikasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aplikasi-search">

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1
                ],
            ]); ?>

            <?php $form->field($model, 'id') ?>

            <?= $form->field($model, 'nma')->textInput(['placeholder' => 'Cari Berdasarkan Nama Aplikasi']) ?>

            <?php $form->field($model, 'inf') ?>

            <?php $form->field($model, 'prm') ?>

            <?php $form->field($model, 'icn') ?>

            <?php // echo $form->field($model, 'lnk') ?>

            <?php // echo $form->field($model, 'kda') ?>

            <?php // echo $form->field($model, 'sta')->checkbox() ?>

            <?php // echo $form->field($model, 'crd') ?>

            <?php // echo $form->field($model, 'mdd') ?>

            <div class="form-group">
                <?= Html::submitButton('<span class="fa fa-search"></span> Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('<span class="fa fa-spinner"></span> Reset', ['class' => 'btn btn-info']) ?>
                <?= Html::a('<span class="fa fa-plus"></span> Tambah Aplikasi', ['create'], ['class' => 'btn btn-success btn-flat']) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
