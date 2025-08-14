<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\DOKTER;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\McuPaketTindakanMcu;

/* @var $this yii\web\View */
/* @var $model app\models\McuDokterPaketTindakanMcu */
/* @var $form yii\widgets\ActiveForm */
    $dokter = DOKTER::find()->all();
    $paket_tindakan = McuPaketTindakanMcu::find()->all();

    $this->registerJs(
    
   '$("document").ready(function(){ 
		$("#tindakan_mcu_dokter_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#paket-tindakan-mcu-dokter"});  //Reload GridView
            Swal.fire({
                title: "Data Berhasil Ditambahkan",
                icon: "success",
                timer: 3000,
                showConfirmButton: true
            }); 
            $("#addModal").modal("hide");        
            $("#form-tindakan-mcu-dokter").trigger("reset"); 
           
           
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);
?>

<div class="mcu-dokter-paket-tindakan-mcu-form">

    <?php Pjax::begin(['id'=>'tindakan_mcu_dokter_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-tindakan-mcu-dokter','options' => ['data-pjax' => true ]]); ?>

            <?= $form->field($model,'kode_dokter')->widget(Select2::className(),[
                'data' =>  ArrayHelper::map($dokter,'KODE','NAMA'),
                'options' => [
                    'placeholder' => '== Pilih Dokter ==',
                    'class'=>'form-control-sm'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) 
            ?>

            <?= $form->field($model, 'tanggal')->widget(DatePicker::classname(), [
                    'options' => ['autocomplete' => 'off', 'placeholder' => 'Tanggal...'],
                    'removeButton' => false,
                    'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                        ]
                    ]);
            ?>

            <?= $form->field($model,'id_paket_tindakan_mcu')->widget(Select2::className(),[
                'data' =>  ArrayHelper::map($paket_tindakan,'id','nama_tindakan'),
                'options' => [
                    'placeholder' => 'Pilih Paket Tindakan',
                    'class'=>'form-control-sm'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) 
            ?>

            <?php if (!Yii::$app->request->isAjax){ ?>
                <div class="form-group float-sm-right">
                    <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php } ?>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
    
    
</div>
