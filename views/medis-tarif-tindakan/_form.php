<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTarifTindakan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="medis-tarif-tindakan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'sk_tarif_id')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($sk_tarif,'id','nomor'),
        'options' => [
            'id'=>'SKTarif',
            'placeholder' => 'Pilih SK Tarif',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model,'kelas_rawat_kode')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($kelas_rawat,'kode','nama'),
        'options' => [
            'id'=>'KelasRawat',
            'placeholder' => 'Pilih Kelas Rawat',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>
    
    <?= $form->field($model,'tindakan_id')->widget(Select2::className(),[
        'data' =>  ArrayHelper::map($tindakan,'id','deskripsi'),
        'options' => [
            'id'=>'Tindakan',
            'placeholder' => 'Pilih Tindakan',
            'class'=>'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>

     

    <div class="row">
        <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
                <?= $form->field($model, 'js_adm')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <?= $form->field($model, 'js_sarana')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <?= $form->field($model, 'js_bhp')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <?= $form->field($model, 'js_dokter_operator')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <?= $form->field($model, 'js_dokter_lainya')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <?= $form->field($model, 'js_dokter_anastesi')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <?= $form->field($model, 'js_penata_anastesi')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <?= $form->field($model, 'js_paramedis')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <?= $form->field($model, 'js_lainya')->textInput(['type' => 'number', 'onkeyup' => 'count_non_cto()']) ?>

                <input type='text' class="form-control" id='JumlahJsNonCTO' readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <?= $form->field($model, 'js_adm_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <?= $form->field($model, 'js_sarana_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <?= $form->field($model, 'js_bhp_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <?= $form->field($model, 'js_dokter_operator_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <?= $form->field($model, 'js_dokter_lainya_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <?= $form->field($model, 'js_dokter_anastesi_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <?= $form->field($model, 'js_penata_anastesi_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <?= $form->field($model, 'js_paramedis_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <?= $form->field($model, 'js_lainya_cto')->textInput(['type' => 'number', 'onkeyup' => 'count_cto()']) ?>

                <input type='text' class="form-control" id='JumlahJsCTO' readonly>
            </div>
        </div>
    </div>

    

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("    
   $('#KelasRawat').on('change',function(){
    //    alert('ADdaa');
    var data = {
        sk : $('#SKTarif option:selected').val(), 
        kelas : $('#KelasRawat option:selected').val()
    }
    // console.log(data)
       $.ajax({
           url:'".Url::to(['tindakannya'])."',
           type:'POST',
           data: data,
           dataType:'json',
           success:function(result){
               //alert(test);
                $.each(result, function (i, data) {
                    //console.log(i);
                    console.log(data);
                    $('#Tindakan').append(`
                    <option value='`+data.id+`'>`+data.deskripsi+`</option>
                    `);
                });
           }
       })
   });
");
?>

<script>
    function count_non_cto() {
        var js_adm = document.getElementById('medistariftindakan-js_adm').value;
        var js_sarana = document.getElementById('medistariftindakan-js_sarana').value;
        var js_bhp = document.getElementById('medistariftindakan-js_bhp').value;
        var js_dokter_operator = document.getElementById('medistariftindakan-js_dokter_operator').value;
        var js_dokter_lainya = document.getElementById('medistariftindakan-js_dokter_lainya').value;
        var js_dokter_anastesi = document.getElementById('medistariftindakan-js_dokter_anastesi').value;
        var js_penata_anastesi = document.getElementById('medistariftindakan-js_penata_anastesi').value;
        var js_paramedis = document.getElementById('medistariftindakan-js_paramedis').value;
        var js_lainya = document.getElementById('medistariftindakan-js_lainya').value;
        var result = (parseInt(js_adm)) + (parseInt(js_sarana)) + (parseInt(js_bhp)) + (parseInt(js_dokter_operator)) + (parseInt(js_dokter_lainya)) + (parseInt(js_dokter_anastesi)) + (parseInt(js_penata_anastesi)) + (parseInt(js_paramedis)) + (parseInt(js_lainya));
        if (!isNaN(result)) {
            document.getElementById('JumlahJsNonCTO').value = result;
        }
    }

    function count_cto() {
        var js_adm_cto = document.getElementById('medistariftindakan-js_adm_cto').value;
        var js_sarana_cto = document.getElementById('medistariftindakan-js_sarana_cto').value;
        var js_bhp_cto = document.getElementById('medistariftindakan-js_bhp_cto').value;
        var js_dokter_operator_cto = document.getElementById('medistariftindakan-js_dokter_operator_cto').value;
        var js_dokter_lainya_cto = document.getElementById('medistariftindakan-js_dokter_lainya_cto').value;
        var js_dokter_anastesi_cto = document.getElementById('medistariftindakan-js_dokter_anastesi_cto').value;
        var js_penata_anastesi_cto = document.getElementById('medistariftindakan-js_penata_anastesi_cto').value;
        var js_paramedis_cto = document.getElementById('medistariftindakan-js_paramedis_cto').value;
        var js_lainya_cto = document.getElementById('medistariftindakan-js_lainya_cto').value;
        var result = (parseInt(js_adm_cto)) + (parseInt(js_sarana_cto)) + (parseInt(js_bhp_cto)) + (parseInt(js_dokter_operator_cto)) + (parseInt(js_dokter_lainya_cto)) + (parseInt(js_dokter_anastesi_cto)) + (parseInt(js_penata_anastesi_cto)) + (parseInt(js_paramedis_cto)) + (parseInt(js_lainya_cto));
        if (!isNaN(result)) {
            document.getElementById('JumlahJsCTO').value = result;
        }
    }
</script>
