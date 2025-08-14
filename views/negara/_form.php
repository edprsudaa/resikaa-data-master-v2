<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap4\Dropdown;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Negara */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#negara_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#negara"});  //Reload GridView
            $("#addModal").modal("hide");        
           
            Swal.fire({
                title: "Data Berhasil Ditambahkan",
                icon: "success",
                timer: 4000,
                showConfirmButton: true
            }); 
            $("#form-negara").trigger("reset"); 
             
                                      
		});
    });'
);
?>


<div class="negara-form">

<?php Pjax::begin(['id'=>'negara_pjax']); ?>

    <?php $form = ActiveForm::begin(['id'=> 'form-negara','options' => ['data-pjax' => true ]]); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true])->label('Kode Negara') ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label('Nama Negara') ?>

    
    <?= 
        $form->field($model, 'aktif')->widget(Select2::classname(), [
            'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
            // 'options' => ['placeholder' => 'Pilih...'],
            'value'   => '1'
            ])->label('Status'); 
    ?>
      
      <!-- <?php if(!$model->isNewRecord):?> -->
    <!-- <?php endif;?> -->

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?> -->

    <div class="form-group float-sm-right">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id' => 'submit-button', ]) ?>    
    </div>


    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>

</div>
