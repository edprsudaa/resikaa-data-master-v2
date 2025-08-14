<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedisIcd10cm */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#icd_10_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#icd-10-pjax"});  //Reload GridView
           
           
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);

?>

<div class="medis-icd10cm-form">

    <?php Pjax::begin(['id'=>'icd_10_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-icd-10','options' => ['data-pjax' => true ]]); ?>

            <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'id'=>'kode']) ?>

            <?= $form->field($model, 'deskripsi')->textarea(['rows' => 5, 'id'=>'deskripsi']) ?>

            <?php

                if (!$model->isNewRecord) {
                    echo $form->field($model, 'aktif')->widget(Select2::class, [
                        'data' =>  ['' => 'Pilih Status', '1' => 'Aktif', '0' => 'Tidak Aktif'],
                        'options' => [
                            'id' => 'Status',
                            'placeholder' => 'Pilih Status',
                            'class' => 'form-control-sm'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                }

                ?>

            <div class="form-group float-sm-right">
                <?= Html::submitButton('Tambah' ,
                    [
                        'class' =>'btn btn-success btn-submit',                        
                    ]
                ) ?>
            </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
