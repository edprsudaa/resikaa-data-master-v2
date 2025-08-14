<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TindKel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tind-kel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datatk')->label(false)->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($tindkel,'id','name'),
        'options' => [
            'id'=>'dataKDKEL',
            'placeholder' => '== Pilih Tindakan ==',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

    <?= $form->field($model, 'KELOMPOK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TINDAKAN')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDKEL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KODE1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KODE2')->hiddenInput(['value'=> '00', 'maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'lNonAktif')->dropDownList(
        ['' => 'Pilih Status','0' => 'Aktif','1' => 'Non Aktif']
        );
    ?> 

    <?= $form->field($model_kelas, 'KodeKelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_kelas, 'Harga_Bhn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_kelas, 'Js_RS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_kelas, 'Js_MedRS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_kelas, 'Js_MedL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_kelas, 'Js_MedTL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_kelas, 'Js_KSO')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?php
$this->registerJs("         
        $('#dataKDKEL').on('change',function(){
            $.ajax({
                url:'".Url::to(['data-tindkel'])."',
                type:'POST',
                data:'kode='+$('#dataKDKEL option:selected').val(),
                dataType:'json',
                success:function(result){
                  var data= result.KODE1;
                  var H=data[0]; 
                  var A=data[1]; 
                if(A=='9'){
                    H=String.fromCharCode(H.charCodeAt() + 1)
                            A='1';
                        }else{
                            A++;
                        }    
                    $('#tindkel-kelompok').val(result.KELOMPOK);
                    $('#tindkel-kdkel').val(result.KDKEL);
                    $('#tindkel-kode1').val(H+A);
                }
            })
        });
");