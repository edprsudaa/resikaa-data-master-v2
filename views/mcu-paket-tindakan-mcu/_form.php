<?php

use app\models\UNIT;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\McuPaket;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\McuPaketTindakanMcu */
/* @var $form yii\widgets\ActiveForm */
$url = \yii\helpers\Url::to(['tarif-list']);

$paket = McuPaket::find()->all();
$unit = UNIT::find()->all();

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#tindakan_mcu_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#paket-tindakan-mcu"});  //Reload GridView
            Swal.fire({
                title: "Data Berhasil Ditambahkan",
                icon: "success",
                timer: 3000,
                showConfirmButton: true
            }); 
            $("#addModal").modal("hide");        
            $("#form-tindakan-mcu").trigger("reset"); 
           
           
           
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);
?>

<div class="mcu-paket-tindakan-mcu-form">
    <?php Pjax::begin(['id'=>'tindakan_mcu_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-tindakan-mcu','options' => ['data-pjax' => true ]]); ?>

            <?= $form->field($model,'kode_paket')->widget(Select2::className(),[
                'data' =>  ArrayHelper::map($paket,'kode','nama'),
                'options' => [
                   
                    'placeholder' => '== Pilih Paket ==',
                    'class'=>'form-control-sm'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) 
            ?>

            <?= $form->field($model, 'kode_tindakan')->widget(Select2::classname(), [
                'options' => ['id'=>'Tindakan', 'multiple'=>false, 'placeholder' => 'Cari Tindakan...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => $url,
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { 
                            var kode_paket = $("#PaketID").val();
                            return {q:params.term, d:kode_paket}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                    ],
                ]);
            ?>

            <?= $form->field($model,'kode_unit')->widget(Select2::className(),[
                'data' =>  ArrayHelper::map($unit,'KD_INST','KET'),
                'options' => [
                    'placeholder' => '== Pilih Unit ==',
                    'class'=>'form-control-sm'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) 
            ?>

            <!-- <?= $form->field($model, 'nama_tabel')->textInput(['rows' => 6]) ?>

            <?= $form->field($model, 'nama_kolom1')->textInput(['rows' => 6]) ?> -->

            <!-- <?= $form->field($model, 'nama_kolom2')->textInput(['rows' => 6]) ?> -->

            <?= $form->field($model, 'nama_tindakan')->textInput(['maxlength' => true,'readOnly'=>true]) ?>

            <?= $form->field($model, 'harga')->textInput([ 'readonly' => true]) ?>


            <?php if (!Yii::$app->request->isAjax){ ?>
                <div class="form-group float-sm-right">
                    <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php } ?>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
    
</div>

<?php
$script = <<< JS
$(function()
{
     $("#Tindakan").trigger('change');
});

JS;
$this->registerJs($script);
?>

<?php
$this->registerJs("    
   $('#Tindakan').on('change',function(){
       $.ajax({
           url:'".Url::to(['jml-tarif'])."',
           type:'POST',
           data:'kode='+$('#Tindakan option:selected').val(),
           dataType:'json',
           success:function(result){
                $('#mcupakettindakanmcu-nama_tindakan').val(result[0]);
                $('#mcupakettindakanmcu-harga').val(result[1]);
           }
       })
   });
");
?>
