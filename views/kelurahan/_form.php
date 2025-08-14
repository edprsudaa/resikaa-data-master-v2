<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Kabupaten;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kelurahan */
/* @var $form yii\bootstrap4\ActiveForm */
$provinsi = Kabupaten::getProvincies();
?>

<div class="kelurahan-form">

    <?php Pjax::begin(['id'=>'kelurahan_pjax']); ?>
        <?php $form = ActiveForm::begin([
                'id' => 'form-kelurahan',
                'options' => [
                    'data-pjax' => true,
                ]
            ]); ?>

            <?= 
                $form->field($model, 'kode_prov')->widget(Select2::classname(), [
                        'data' => $provinsi,
                        'options'   => [
                            'placeholder' => 'Pilih Provinsi...',
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

            <?= 
                $form->field($model, 'kode_prov_kab_kec')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'kecamatan'],
                    'type' => DepDrop::TYPE_SELECT2,
                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                    'pluginOptions' => [
                        'depends' => ['kabupaten'],
                        'placeholder' => '-- Pilih Kecamatan --',
                        'url' => Url::to(['/kecamatan/get-kecamatan-by-kabupaten'])
                    ]
                ])->label('Kecamatan');
            ?>

            <?= $form->field($model, 'kode_prov_kab_kec_kelurahan')->textInput(['maxlength' => true])->label('Kode Kelurahan') ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label('Nama Kelurahan') ?>

            <?php if(!$model->isNewRecord):?>

                <?= 
                    $form->field($model, 'aktif')->widget(Select2::classname(), [
                        'data' => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                        'options' => ['placeholder' => 'Pilih...'],
                    ])->label('Status'); 
                ?>

             <?php endif;?>


            <div class="form-group float-sm-right">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
