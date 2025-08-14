<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Kabupaten;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kabupaten */
/* @var $form yii\bootstrap4\ActiveForm */

$provinsi = Kabupaten::getProvincies();


$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#kabupaten_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#kabupaten-pjax"});  //Reload GridView           
           
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);
?>

<div class="kabupaten-form">

    <?php Pjax::begin(['id'=>'kabupaten_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-kabupaten','options' => ['data-pjax' => true ]]); ?>

            <?= 
                $form->field($model, 'kode_prov')->widget(Select2::classname(), [
                        'data' => $provinsi,
                        'options' => [
                            'placeholder' => 'Pilih...',
                            'id' => 'kode_prov'
                        ],
                    ])->label('Provinsi'); 
            ?>
            

            <?= $form->field($model, 'kode_prov_kabupaten')->textInput(['maxlength' => true, 'id'=>'kode_prov_kab', 'autocomplete'=>'off'])->label('Kode Kabupaten/Kota') ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'id'=>'nama','autocomplete'=>'off'])->label('Nama Kabupaten/Kota') ?>

            <?= 
                    $form->field($model, 'jenis')->widget(Select2::classname(), [
                        'data' => ['KABUPATEN' => 'KABUPATEN', 'KOTA' => 'KOTA'],
                        'options' => ['placeholder' => 'Pilih...', 'id'=>'jenis'],
                    ])->label('Jenis Daerah'); 
                ?>

            <!-- <?= $form->field($model, 'kode_prov')->textInput() ?> -->

            <?php if(!$model->isNewRecord):?>

                <?= 
                    $form->field($model, 'aktif')->widget(Select2::classname(), [
                        'data' => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                        'options' => ['placeholder' => 'Pilih...'],
                    ])->label('Status'); 
                ?>

            <?php endif;?>

            <!-- <?= $form->field($model, 'created_at')->textInput() ?>

            <?= $form->field($model, 'created_by')->textInput() ?>

            <?= $form->field($model, 'updated_at')->textInput() ?>

            <?= $form->field($model, 'updated_by')->textInput() ?>

            <?= $form->field($model, 'is_deleted')->textInput() ?> -->

            <div class="form-group float-sm-right">
                <?= Html::submitButton('Tambah' ,
                    [
                        'class' =>'btn btn-success btn-submit',                        
                    ]
                ) ?>
            </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>

