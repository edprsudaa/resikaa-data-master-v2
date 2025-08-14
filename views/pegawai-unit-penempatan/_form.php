<?php

use app\models\UNIT;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use app\models\PegawaiUnitPenempatan;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiUnitPenempatan */
/* @var $form yii\bootstrap4\ActiveForm */

$unit_rumpun = PegawaiUnitPenempatan::find()->orderBy(['kode'=> SORT_ASC])->all();

$unit = UNIT::find()->orderBy(['KET' => SORT_ASC])->all();

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#unit_penempatan_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#unit_penempatan"});  //Reload GridView
            $("#addModal").modal("hide");        
           
            Swal.fire({
                title: "Data Berhasil Ditambahkan",
                icon: "success",
                timer: 4000,
                showConfirmButton: true
            }); 
            $("#form-unit-penempatan").trigger("reset"); 
             $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);

?>

<div class="pegawai-unit-penempatan-form">

    <?php Pjax::begin(['id'=>'unit_penempatan_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-unit-penempatan','options' => ['data-pjax' => true ]]); ?>

            <?= $form->field($model,'unit_rumpun')->widget(Select2::className(),[
                    'data' =>  ArrayHelper::map($unit_rumpun,'kode','nama'),
                    'options' => [
                        'id'=>'unit_rumpun',
                        'placeholder' => '== Pilih Group Organisasi ==',
                        'class'=>'form-control-sm'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) 
            ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model,'kode_unitsub_maping_simrs')->widget(Select2::className(),[
                    'data' =>  ArrayHelper::map($unit,'KD_INST','KET'),
                    'options' => [
                        'id'=>'kode_unitsub_maping_simrs',
                        'placeholder' => '== Pilih Unit Maping ==',
                        'class'=>'form-control-sm'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->hint('*ABAIKAN JIKA TIDAK ADA UNIT MAPING') 
            ?>

            <div class="form-group">
                <label for="exampleInputEmail1">Kelompok Layanan</label>
                <div class="row">
                    <div class="col"><?= $form->field($model, 'is_igd')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_rj')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_ri')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_lab_pa')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_lab_pk')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_radiologi')->checkbox(['value' => 1]) ?></div>
                </div>
                 <div class="row">
                    <div class="col"><?= $form->field($model, 'is_ok')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_hd')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_lab_bio')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_radioterapi')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_rehab_medik')->checkbox(['value' => 1]) ?></div>
                    <div class="col"><?= $form->field($model, 'is_penunjang')->checkbox(['value' => 1]) ?></div>
                </div>
            </div>

            

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
