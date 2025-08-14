<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranKelompokUnitLayanan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="pendaftaran-kelompok-unit-layanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'type')->widget(Select2::className(),[
        'data' =>  ['' => 'Pilih Type','1' => 'IGD','2' => 'RAWAT JALAN REGULER','3' => 'RAWAT INAP','4' => 'PENUNJANG','5' => 'RAWAT JALAN UTAMA'],
        'options' => [
            'id'=>'KodeType',
            'placeholder' => 'Pilih Type',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model,'unit_id')->widget(Select2::className(),[
            //'data' =>  ArrayHelper::map($unit,'kode','nama'),
            'options' => [
                'id'=>'KodeUnit',
                'placeholder' => 'Pilih Unit',
                'class'=>'form-control-sm'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) 
    ?>

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("    
   $('#KodeType').on('change',function(){
    // console.log(data)
       $.ajax({
           url:'".Url::to(['unitnya'])."',
           type:'POST',
           data: 'kode='+$('#KodeType option:selected').val(),
           dataType:'json',
           success:function(result){
               //alert(test);
                $.each(result, function (i, data) {
                    //console.log(i);
                    console.log(data);
                    $('#KodeUnit').append(`
                    <option value='`+data.kode+`'>`+data.nama+`</option>
                    `);
                });
           }
       })
   });
");
?>