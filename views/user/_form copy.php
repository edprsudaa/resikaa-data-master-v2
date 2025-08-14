<?php

use app\components\HelperSso;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AkunAknUser */
/* @var $form yii\widgets\ActiveForm */

$role = ['pegawai' => 'Pegawai', 'dokter' => 'Dokter', 'perawat' => 'Perawat'];
$dataPegawai = HelperSso::getDataPegawai();

?>

<div class="card card-body">
	<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) : ?>

		<div class="alert alert-danger">
			Data Telah Terdaftar!!!!!!!!!!!!!!!!!!!!!!!!
		</div>
	<?php endif; ?>
	<?php $form = ActiveForm::begin(); ?>
		<div class="row">
			<?php if ($model->isNewRecord) : ?>
				<div class="col-lg-12">
					<?= $form->field($model, 'id_pegawai')->widget(Select2::classname(), [
						'data' => \yii\helpers\ArrayHelper::map($dataPegawai, 'pegawai_id', 'nama_lengkap'),
						'language' => 'en',
						'options' => ['placeholder' => 'Pilih Pegawai'],
						'pluginOptions' => [
							'allowClear' => true
						],
					]); ?>
				</div>
			<?php endif; ?>
			<div class="col-lg-12">
				<?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username Berdasarkan Nip', 'readonly' => true]) ?>
			</div>
			<div class="col-lg-12">
				<?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama Lengkap']) ?>
			</div>
			<?php if ($model->isNewRecord) : ?>
				<div class="col-lg-12">
					<?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Password']) ?>
				</div>
			<?php endif; ?>
		</div>


		<?php $form->field($model, 'tanggal_pendaftaran')->textInput() ?>

		<?php $form->field($model, 'role')->dropDownList($role, ['prompt' => 'Pilih Role Identitas']) ?>
		<?= $form->field($model, 'role')->widget(Select2::classname(), [
			'data' => HelperSso::TypeUser,
			'language' => 'en',
			'options' => ['placeholder' => 'Pilih Role'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); ?>
		<?php $form->field($model, 'token_aktivasi')->textarea(['rows' => 6]) ?>

		<?php $form->field($model, 'status')->textInput() ?>

	
		<?= Html::submitButton('Save <span class="fa fa-save"></span>', ['class' => 'btn btn-success btn-flat']) ?>
	
	<?php ActiveForm::end(); ?>
</div>


<?php
$JS = <<< JS
    $("#akunaknuser-id_pegawai").change(function() {
      // alert("asdasdas");
      var akun = $(this).val();
      $.get('get-pegawai',{id:akun},function(data) {
        // akunaknuser-username
        console.log(data);

		if(data.results.status_kepegawaian_id  == '141'){
        	$("#akunaknuser-username").attr('value',data.results.nomor_ktp);
		}else{
        	$("#akunaknuser-username").attr('value',data.results.id_nip_nrp);
			
		}
        // akunaknuser-nama
        $("#akunaknuser-nama").attr('value',data.results.nama_lengkap)
      },'JSON');
    });
JS;
$this->registerJs($JS)
?>