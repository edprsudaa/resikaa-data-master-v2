<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Provinsi;
use app\models\Kabupaten;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */
/* @var $form yii\bootstrap4\ActiveForm */
 $provinsi = Kabupaten::getProvincies();

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#kecamatan_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#kecamatan"});  //Reload GridView
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);

?>

<div class="kecamatan-form">

    <?php Pjax::begin(['id'=>'kecamatan_pjax']); ?>
        <?php $form = ActiveForm::begin([
                'id' => 'form-kecamatan',
                'options' => [
                    'data-pjax' => true,
                ]
            ]); ?>

    
            <?= 
                $form->field($model, 'kode_prov')->widget(Select2::classname(), [
                        'data' => $provinsi,
                        'options'   => [
                            'placeholder' => 'Pilih...',
                            'id'        => 'provinsi'
                        ],            
                    ])->label('Provinsi'); 

                // $form->field($model, 'kode_prov')->dropDownList(ArrayHelper::map(Provinsi::find()->all(), 'kode','nama'),['prompt' => 'select','id'=>'kodeProv','class'=>'form-control']);
            ?>

            <?= 
                $form->field($model, 'kode_prov_kab')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'kabupaten'],
                    'type' => DepDrop::TYPE_SELECT2,
                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                    'pluginOptions' => [
                        'depends' => ['provinsi'],
                        'placeholder' => '-- Pilih Kab/Kota --',
                        'url' => Url::to(['/kabupaten/get-kabupaten-by-provinsi'])
                    ]
                ])->label('Kabupaten/Kota');
            ?>

            <?= $form->field($model, 'kode_prov_kab_kecamatan')->textInput(['maxlength' => true])->label('Kode Kecamatan') ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label('Nama Kecamatan') ?>

            <?php if(!$model->isNewRecord):?>

                <?= 
                    $form->field($model, 'aktif')->widget(Select2::classname(), [
                        'data' => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                        'options' => ['placeholder' => 'Pilih...'],
                    ])->label('Status'); 
                ?>

            <?php endif;?>

            <div class="form-group float-sm-right">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id'=>'btnSubmit']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
