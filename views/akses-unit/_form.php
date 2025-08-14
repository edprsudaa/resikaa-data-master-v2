<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Aplikasi;
use app\models\AkunAknUser;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\HelperSso;
use app\components\HelperSpesial;
use app\models\PegawaiUnitPenempatan;

/* @var $this yii\web\View */
/* @var $model app\models\AksesUnit */
/* @var $form yii\widgets\ActiveForm */

$dataPengguna = AkunAknUser::find()->all();
$unit = PegawaiUnitPenempatan::find()->where(['aktif'=> 1])->orderBy(['nama'=> SORT_ASC])->all();
$aplikasi = Aplikasi::find()->orderBy(['nma'=> SORT_ASC])->all();

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#akses_unit_pjax").on("pjax:end", function() {
            $("#form-akses-unit").trigger("reset");
            $.pjax.reload("#akses-unit", {timeout:3000});
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);

?>

<div class="akses-unit-form">

    <?php Pjax::begin(['id'=>'akses_unit_pjax']); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'form-akses-unit',
            'options' => [
                'data-pjax' => true,
            ]
        ]); ?>

            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'pengguna_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($dataPengguna, 'userid', 'nama'),
                        'options' => ['placeholder' => 'Pilih Nama Pegawai...','id'=>'pengguna_form'],
                        'pluginOptions' => [
                        'allowClear' => false
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'unit_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map($unit,'kode','nama'),
                        'options' => ['placeholder' => 'Pilih Unit...'],
                        'pluginOptions' => [
                        'allowClear' => false
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'id_aplikasi')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map($aplikasi,'id','nma'),
                        'options' => ['placeholder' => 'Pilih Aplikasi...'],
                        'pluginOptions' => [
                        'allowClear' => false
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-lg-2">
                    <div class="box-footer">
                        <label for="" style="color:white">s</label>
                        <?= Html::submitButton('Tambah', ['class' => 'btn btn-success btn-block btn-flat', 'id'=>'btnSubmit']) ?>
                    </div>
                </div>
            </div>    

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
