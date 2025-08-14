<?php

use app\components\Helper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTindakan */
/* @var $form yii\bootstrap4\ActiveForm */
$id = $_GET['id'];
?>

<div class="card card-default">
    <div class="card-header">
    <h3 class="card-title">Import data ICD 10 CM ("<?= Helper::getIcd10Cm($id) ?>")</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="medis-icd10cm-form">

            <?php $form = ActiveForm::begin([
                'options'=> ['enctype' => 'multipart/form-data']
            ]); ?>

            <?= $form->field($model,'generasi')->widget(Select2::className(),[
                'name' => 'generasi',
                'data' =>  ['' => 'Pilih Generasi','1' => 'Generasi 1','2' => 'Generasi 2','3' => 'Generasi 3','4' => 'Generasi 4'],
                'options' => [
                    'id'=>'generasi',
                    'placeholder' => 'Pilih Generasi',
                    'class'=>'form-control-sm'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) 
            ?>

            <!-- <?= $form->field($model, 'id')->label(false)->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'kode')->label(false)->textInput(['maxlength' => true]) ?> -->

            <?= $form->field($model, 'importFile')->label(false)->fileInput(['maxlength' => true]) ?>
            
            <?= Html::submitButton('Save', ['class' => 'btn-sm btn-success']) ?>
            <?= Html::hiddenInput(Yii::$app->request->csrfParam,Yii::$app->request->csrfToken) ?> 

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>