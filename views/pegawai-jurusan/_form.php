<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use app\models\PegawaiJurusan;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiJurusan */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php

$jenisPendidikan = PegawaiJurusan::getAllJenisPendidikan();

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#jurusan_pjax").on("pjax:end", function() {
            $.pjax.reload({container:"#jurusan"});  //Reload GridView
            $("#addModal").modal("hide");        
           
            Swal.fire({
                title: "Data Berhasil Ditambahkan",
                icon: "success",
                timer: 4000,
                showConfirmButton: true
            }); 
            $("#form-jurusan").trigger("reset"); 
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);
?>

<div class="pegawai-jurusan-form">
    <?php Pjax::begin(['id'=>'jurusan_pjax']); ?>
       <?php $form = ActiveForm::begin(['id'=> 'form-jurusan','options' => ['data-pjax' => true ]]); ?>

        
        <?= 
         $form->field($model, 'kode')->widget(Select2::classname(), [
                'data' => $jenisPendidikan,
                'options' => [
                    'placeholder' => 'Pilih...',
                    'id' => 'jenisPendidikan',
                ],
            ]); 
        ?>

        <?= $form->field($model, 'kode_jurusan')->textInput(['id'=>'kode', 'readonly'=>true]) ?>

        <?= $form->field($model, 'nama_jurusan')->textInput(['maxlength' => true]) ?>

        <?= 
            $form->field($model, 'aktif')->widget(Select2::classname(), [
                'data'    => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
                // 'options' => ['placeholder' => 'Pilih...'],
                'value'   => '1'
                ])->label('Status'); 
        ?>

        <!-- <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'created_by')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'updated_by')->textInput() ?>

        <?= $form->field($model, 'is_deleted')->textInput() ?> -->

        <div class="form-group float-sm-right">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>

<script>
    
    $("#jenisPendidikan").on("select2:select", function(e) {
        var kode = e.params.data.id;
        // alert(kode);
        $.ajax({
            url: '<?php echo Url::to(['pegawai-jurusan/get-max-kode']) ?>',
            type: "post",
            data: {
                kode: kode,
            },
            success: function(data) {
                console.log('response : ', data);
                $("#kode").val(data.data);
            }
        });
    });

</script>
