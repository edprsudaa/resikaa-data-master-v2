<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiStatusKepegawaian */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#kepegawaian_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#status_kepegawaian"});  //Reload GridView
            $("#addModal").modal("hide");        
           
            Swal.fire({
                title: "Data Berhasil Ditambahkan",
                icon: "success",
                timer: 4000,
                showConfirmButton: true
            }); 
            $("#form-status-kepegawaian").trigger("reset"); 
             
                                      
		});
    });'
);
?>




<div class="pegawai-status-kepegawaian-form">
    <?php Pjax::begin(['id'=>'kepegawaian_pjax']); ?>
        <?php $form = ActiveForm::begin(['id'=> 'form-status-kepegawaian','options' => ['data-pjax' => true ]]); ?>

            <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

            <?= 
                $form->field($model, 'kategori')->widget(Select2::classname(), [
                    'data' => [1 => 'ASN', 2 => 'Kontrak', 3 => 'OutSourching'],
                    'options' => [
                        
                        'placeholder' => 'Pilih...'
                    ],
                    ]); 
            ?>

            <div class="form-group float-sm-right">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>

