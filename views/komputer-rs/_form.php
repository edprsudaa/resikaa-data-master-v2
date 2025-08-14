<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\KomputerRs;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use app\models\PegawaiUnitPenempatan;


$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#komputer_rs_pjax").on("pjax:end", function() {
            $("#form-komputer-rs").trigger("reset");
            $.pjax.reload("#komputer-rs", {timeout:3000});
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);


$unitPenempatan = PegawaiUnitPenempatan::find()
    ->where(['aktif' => 1])
    ->orderBy(['nama' => SORT_ASC])
    ->all();

?>

<div class="komputer-rs-form">

    <?php Pjax::begin(['id'=>'komputer_rs_pjax']); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'form-komputer-rs',
            'options' => [
                'data-pjax' => true,
            ]
        ]); ?>
        
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'nama_ruangan')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map($unitPenempatan, 'kode', 'nama'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => ['placeholder' => 'Pilih Ruangan...','multiple' => true],
                            'pluginOptions' => [ 
                                'allowClear' => false,
                            ],
                        ]);
                    ?>
                    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                    
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'mac_address')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                   
                    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success d-flex float-right btn-flat', 'id'=>'btnSubmit']) ?>
                </div>
               
            </div>


        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
