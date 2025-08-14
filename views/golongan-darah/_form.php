<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use app\models\GolonganDarah;


$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#golongan_darah_pjax").on("pjax:end", function() {
            $("#form-golongan-darah").trigger("reset");
            $.pjax.reload("#golongan-darah", {timeout:3000});
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);



?>

<div class="golongan-darah-form">

    <?php Pjax::begin(['id'=>'golongan_darah_pjax']); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'form-golongan-darah',
            'options' => [
                'data-pjax' => true,
            ]
        ]); ?>
        
            <div class="row">                
                <div class="col-10">
                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'autocomplete' => 'off','id'=>'nama']) ?>
                </div>

                <div class="col-2">
                    <label for="" style="color:white">s</label>
                    <br>
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success ', 'id'=>'btnSubmit']) ?>
                </div>
               
            </div>


        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
