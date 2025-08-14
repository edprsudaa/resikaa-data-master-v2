<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Aplikasi */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#aplikasi_pjax").on("pjax:end", function() {

            $("#form-aplikasi").trigger("reset");
            $.pjax.reload("#aplikasi", {timeout: 3000});
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);

?>

<div class="aplikasi-form box box-primary">
    <?php Pjax::begin(['id'=>'aplikasi_pjax']); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'form-aplikasi',
            'options' => [
                'data-pjax' => true,
            ]
        ]); ?>
            <div class="card card-body">
                <div class="row">
                    <div class="col-lg-6 col-xl-6 col-md-6">
                        <?= $form->field($model, 'nma')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6">
                        <?= $form->field($model, 'prm')->textInput(['maxlength' => true]) ?>
                    </div>

                    <?php // $form->field($model, 'icn')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'inf')->textarea(['rows' => 2, 'placeholder' => 'Deskripsi Aplikasi']) ?>

                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'lnk')->textarea(['rows' => 2, 'placeholder' => 'Link Aplikasi Aplikasi']) ?>
                    </div>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success btn-block btn-flat', 'id'=>'btnSubmit']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>

