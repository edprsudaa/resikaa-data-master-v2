<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use app\models\PegawaiUnitPenempatan;
use app\models\PegawaiUnitSubPenempatan;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiUnitSubPenempatan */
/* @var $form yii\bootstrap4\ActiveForm */

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#jabatan_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#jabatan"});  //Reload GridView
            $("#addModal").modal("hide");        
           
            Swal.fire({
                title: "Data Berhasil Ditambahkan",
                icon: "success",
                timer: 4000,
                showConfirmButton: true
            }); 
            $("#form-jabatan").trigger("reset"); 
             $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);
$unit = PegawaiUnitPenempatan::find()->orderBy(['kode'=>SORT_ASC])->all();
$atasan = PegawaiUnitSubPenempatan::find()->orderBy(['kode'=>SORT_ASC])->all();
?>


<div class="pegawai-unit-sub-penempatan-form">

    <?php Pjax::begin(['id'=>'jabatan_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-jabatan','options' => ['data-pjax' => true ]]); ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'kode_rumpun')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($atasan, 'kode', 'nama'),
                'options' => [
                    'placeholder' => 'Pilih...',
                    'id' => 'kode_rumpun',
                ],
            ]); 
        ?>

        <?= $form->field($model, 'kode_group')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($unit, 'kode', 'nama'),
                'options' => [
                    'placeholder' => 'Pilih...',
                    'id' => 'kode_group',
                ],
            ]); 
        ?>


        <?= 
            $form->field($model, 'aktif')->widget(Select2::classname(), [
                'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                // 'options' => ['placeholder' => 'Pilih...'],
                'value'   => '1'
                ])->label('Status'); 
        ?>

        <!-- <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'created_by')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'updated_by')->textInput() ?>

        <?= $form->field($model, 'is_deleted')->textInput() ?> -->

        <div class="form-group float-sm-right">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
