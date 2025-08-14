<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MappingDpjp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-dpjp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bpjs_dpjp_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'simrs_dpjp_kode')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($pegawai, 'pegawai_id', 'full_name'),
            'options' => ['placeholder' => 'Pilih Dokter...', 'id' => 'simrs_dpjp_kode'],
            'pluginOptions' => [ 
                'allowClear' => false,
            ],
        ]);
    ?>

    <?= $form->field($model, 'poli_kode_bpjs')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($mappingPoliBpjs, 'bpjs_kode', 'bpjs_nama'),
            'options' => ['placeholder' => 'Pilih Poli BPJS...', 'id' => 'poli_kode_bpjs'],
            'pluginOptions' => [ 
                'allowClear' => true,
            ],
        ]);
    ?>

    <?= $form->field($model, 'sub_poli_kode_bpjs')->widget(DepDrop::classname(), [
        'options' => ['id' => 'sub_poli_kode_bpjs'],
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'depends' => ['poli_kode_bpjs'],
            'placeholder' => 'Pilih Sub Poli BPJS...',
            'url' => Url::to(['mapping-dpjp/sub-poli-list']),
            'initialize' => true,
            'initDepends' => ['poli_kode_bpjs'],
            'params' => ['sub_poli_kode_bpjs'],
        ]
    ]); ?>


    <?= $form->field($model, 'kategori_medis')->widget(Select2::classname(), [
        'data' => [
            1 => 'Dokter Umum/Dokter Gigi',
            2 => 'Dokter Spesialis/Dokter Gigi Spesialis',
            3 => 'Dokter Sub Spesialis',
            4 => 'Dokter Konsultan',
        ],
        'options' => ['placeholder' => 'Pilih Kategori Medis...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
$this->registerJs("
    $('#sub_poli_kode_bpjs').on('depdrop:afterLoad', function(event, id) {
        var selected = '{$model->sub_poli_kode_bpjs}';
        $(this).val(selected).trigger('change');
    });
");
?>


</div>


