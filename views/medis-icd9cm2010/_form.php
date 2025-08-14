<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#icd_9_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#icd-9-pjax"});  //Reload GridView
           
           
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);

?>

<div class="medis-icd9cm-form">

    <?php Pjax::begin(['id'=>'icd_9_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-icd-9','options' => ['data-pjax' => true ]]); ?>

            <?php if(!$model->isNewRecord): ?>
                <input type="hidden" name="id" value="<?php echo $model->id; ?>">
            <?php endif;?>

            <?= $form->field($model, 'kode')->textInput(['maxlength' => true, 'autocomplete'=>'off', 'id'=>'kode']) ?>

            <?= $form->field($model, 'deskripsi')->textarea(['rows' => 4, 'id'=>'deskripsi']) ?>

            <?php

                if (!$model->isNewRecord) {
                    echo $form->field($model, 'aktif')->widget(Select2::class, [
                        'data' =>  ['' => 'Pilih Status', '1' => 'Aktif', '0' => 'Tidak Aktif'],
                        'options' => [
                            'id' => 'status',
                            'placeholder' => 'Pilih Status',
                            'class' => 'form-control-sm'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                }

            ?>


            <div class="form-group float-sm-right">
                <?= Html::submitButton(
                    $model->isNewRecord ? 'Tambah' : 'Ubah',
                    [
                        'class' => $model->isNewRecord ? 'btn btn-success btn-submit' : 'btn btn-primary btn-edit',
                        'status' => $model->isNewRecord ? 'Ditambah' : 'Diperbarui',
                    ]
                ) ?>
            </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>

