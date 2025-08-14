<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\models\PegawaiUnitPenempatan;

/* @var $this yii\web\View */
/* @var $model app\models\BpjskesMappingPoliNew */
/* @var $form yii\widgets\ActiveForm */

$unitPenempatan = PegawaiUnitPenempatan::find()->where(['aktif'=>1])->andWhere(['not',['kode_unitsub_maping_simrs' => null]])->orderBy(['nama'=>SORT_ASC])->all();

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#bpjskes_mapping_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#bpjskes-mapping"});  //Reload GridView
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);

?>

<div class="bpjskes-mapping-poli-new-form">
    <?php Pjax::begin(['id'=>'bpjskes_mapping_pjax']); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'form-bpjskes-mapping',
            'options' => [
                'data-pjax' => true,
            ]
        ]); ?>
            <div class="card card-body">

                <?= $form->field($model, 'bpjs_kode')->textInput(['maxlength' => true, 'autocomplete'=>'off']) ?>

                <?= $form->field($model, 'bpjs_nama')->textInput(['maxlength' => true,'autocomplete'=>'off']) ?>

                <?= $form->field($model, 'bpjs_sub_kode')->textInput(['maxlength' => true, 'autocomplete'=>'off']) ?>

                <?= $form->field($model, 'bpjs_sub_nama')->textInput(['autocomplete'=>'off']) ?>

                <?= $form->field($model, 'simrs_kode')->widget(Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map($unitPenempatan, 'kode', 'nama'),
                    'language' => 'en',
                    'options' => ['placeholder' => 'Pilih Poli Unit','id'=>'simrs_kode_add'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Nama Poli Unit'); ?>
               

            </div>
            <div class="form-group float-sm-right">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id'=>'btnSubmit']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>  
</div>
