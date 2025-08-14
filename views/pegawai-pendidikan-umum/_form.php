<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiPendidikanUmum */
/* @var $form yii\bootstrap4\ActiveForm */
?>


<?php

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#pendidikan_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#pendidikan"});  //Reload GridView
            $("#addModal").modal("hide");        
           
            Swal.fire({
                title: "Data Berhasil Ditambahkan",
                icon: "success",
                timer: 4000,
                showConfirmButton: true
            }); 
            $("#form-pendidikan").trigger("reset"); 
             
                                      
		});
    });'
);
?>

<div class="pegawai-pendidikan-umum-form">
    <?php Pjax::begin(['id'=>'pendidikan_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-pendidikan','options' => ['data-pjax' => true ]]); ?>

            <?= $form->field($model, 'pendidikan_umum')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'kode_max_gol')->textInput(['maxlength' => true]) ?>

            <div class="form-group float-sm-right">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
