<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTindakan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="medis-tindakan-form">

    <?php $form = ActiveForm::begin(); ?>    
    
        <div class="row">
            <div class="col">
                <?= $form->field($model,'parent_id')->widget(Select2::className(),[
                    'data'          =>  $dataParent,
                    'options'       => [
                        'id'          =>'Tindakan',
                        'placeholder' => 'Pilih Tindakan',
                        'class'       =>'form-control-sm'
                    ],
                    'pluginOptions' => [
                        'allowClear'  => true
                    ],
                ]) 
                ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'kode_jenis')->textInput(['maxlength' => true]) ?> 
            </div>
        </div>
        <div class="row">
            <div class="col">
                 <?= $form->field($model, 'deskripsi')->textarea(['rows' => 2]) ?>
            </div>
        </div>
       

       
    
        

       

    <?php if(!$model->isNewRecord):?>
       
        <?= $form->field($model,'aktif')->widget(Select2::className(),[
            'data' =>  ['' => 'Pilih Status','1' => 'Aktif','0' => 'Tidak Aktif'],
            'options' => [
                'id'=>'Status',
                'placeholder' => 'Pilih Status',
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

        <?= $form->field($model, 'updated_by')->textInput() ?>

        <?= $form->field($model, 'is_deleted')->textInput() ?> -->

        <!-- form tarif tindakan -->

        <!-- <div class="card-header mb-3">
            <h3 class="card-title text-bold">Tarif Tindakan</h3>              
        </div>

        <div class="row">
            <div class="col">
                <?= $form->field($modelTarifTindakan,'sk_tarif_id')->widget(Select2::className(),[
                    'data' => $skTarifTindakan,
                    'options' => [
                        // 'id'=>'SKTarif',
                        'placeholder' => 'Pilih SK Tarif',
                        'class'=>'form-control-sm'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
                ?>
            </div>
            <div class="col">
                <?= $form->field($modelTarifTindakan,'kelas_rawat_kode')->widget(Select2::className(),[
                    'data' =>  $kelasRawat,
                    'options' => [
                        // 'id'=>'KelasRawat',
                        'placeholder' => 'Pilih Kelas Rawat',
                        'class'=>'form-control-sm'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) 
                ?>    
            </div>
        </div>

    

   

        <div class="row">
            <div class="col-sm-6">
                
                <div class="form-group">
                    <?= $form->field($modelTarifTindakan, 'js_adm')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_sarana')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_bhp')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_dokter_operator')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_dokter_lainya')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_dokter_anastesi')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_penata_anastesi')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_paramedis')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_lainya')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                    <input type='text' class="form-control" id='JumlahJsNonCTO' readonly>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <?= $form->field($modelTarifTindakan, 'js_adm_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_sarana_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_bhp_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_dokter_operator_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_dokter_lainya_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_dokter_anastesi_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_penata_anastesi_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_paramedis_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <?= $form->field($modelTarifTindakan, 'js_lainya_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                    <input type='text' class="form-control" id='JumlahJsCTO' readonly>
                </div>
            </div>
        </div>

    

        <?= $form->field($modelTarifTindakan, 'created_at')->textInput() ?>

        <?= $form->field($modelTarifTindakan, 'created_by')->textInput() ?>

        <?= $form->field($modelTarifTindakan, 'updated_at')->textInput() ?>

        <?= $form->field($modelTarifTindakan, 'updated_by')->textInput() ?>

        <?= $form->field($modelTarifTindakan, 'is_deleted')->textInput() ?>  -->
        <!-- end form tarif tindakan -->

        <div class="form-group float-sm-right">
            <!-- <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?> -->
            <!-- <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?> -->
        </div>

    <?php endif; ?>

    <div class="form-group float-sm-right">
        <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>