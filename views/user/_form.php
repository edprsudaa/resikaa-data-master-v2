<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\components\HelperSso;

/* @var $this yii\web\View */
/* @var $model app\models\AkunAknUser */
/* @var $form yii\widgets\ActiveForm */

$role = ['pegawai' => 'Pegawai', 'dokter' => 'Dokter', 'perawat' => 'Perawat'];
$dataPegawai = HelperSso::getDataPegawai();

$this->registerJs(
    
   '$("document").ready(function(){ 
		$("#user_pjax").on("pjax:end", function() {
            $("#filter-header").load(location.href + " #filter-header");
             
                                      
		});
    });'
);

?>

<div class="card card-body">
	<?php Pjax::begin(['id'=>'user_pjax']); ?>
        <?php $form = ActiveForm::begin([
            'id' => 'form-user',
            'options' => [
                'data-pjax' => true,
            ]
        ]); ?>
			<div class="row">

				<div class="col-lg-12">
					<?= $form->field($model, 'id_pegawai')->widget(Select2::classname(), [
						'data' => \yii\helpers\ArrayHelper::map($dataPegawai, 'pegawai_id', 'nama_lengkap'),
						'language' => 'en',
						'options' => ['placeholder' => 'Pilih Pegawai','id'=>'pegawai_id'],
						'pluginOptions' => [
							'allowClear' => true
						],
					])->label('Nama Pegawai'); ?>
				</div>
				
				<div class="col-lg-12">
					<?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username Berdasarkan Nip', 'readonly' => true ,'id'=>'username_add']) ?>
				</div>

				<div class="col-lg-12">
					<?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama Lengkap','id'=>'nama_lengkap']) ?>
				</div>

				<div class="col-lg-12">
					<?= $form->field($model, 'password')->textInput(['maxlength' => true, 'placeholder' => 'Password','readonly' => true, 'id'=>'password_add']) ?>
				</div>

				<div class="col-lg-12">
					<?= $form->field($model, 'role')->widget(Select2::classname(), [
						'data' => HelperSso::TypeUser,
						'language' => 'en',
						'options' => ['placeholder' => 'Pilih Role'],
						'pluginOptions' => [
							'allowClear' => true
						],
					]); ?>
				</div>
			</div>		
					
			<div class="form-group float-sm-right">
				<?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id'=>'btnSubmit']) ?>
			</div>
	
		<?php ActiveForm::end(); ?>
	<?php Pjax::end(); ?>
	
</div>



<script>
	$("#pegawai_id").change(function() {
      	var id_pegawai = $(this).val();

	    $.ajax({
            url: '<?php echo Url::to(['user/get-pegawai']) ?>' + '?id=' + id_pegawai,
            type: "POST",
            data: {id: id_pegawai},
            success: function(response) {
				console.log('reponse : ', response);
                $('#username_add').val(response.data.id_nip_nrp);
                $('#nama_lengkap').val(response.data.nama_lengkap);
                $('#password_add').val(response.data.id_nip_nrp);
            }
        });  
    });
</script>
   

