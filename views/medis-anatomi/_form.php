<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedisAnatomi */
/* @var $form yii\bootstrap4\ActiveForm */
?>


<div class="medis-anatomi-form">
  	<?php Pjax::begin(['id'=>'anatomi_pjax']); ?>

		<?php $form = ActiveForm::begin(['id'=>'form-anatomi','options' => ['enctype' => 'multipart/form-data', 'data-pjax' => true]]); ?>

			<?= $form->field($model,'parent_id')->widget(Select2::className(),[
				'data' =>  ArrayHelper::map($anatomiall, 'id_anatomi', 'rumpun'),
				//'data' =>  ArrayHelper::map($tindakan,'id','deskripsi'),
				'options' => [
					// 'id'=>'Tindakan',
					'placeholder' => 'Pilih Anatomi',
					'class'=>'form-control-sm'
				],
				'pluginOptions' => [
					'allowClear' => true
				],
			]) 
			?>

			<div class="row">
				<div class="col">

					<?= $form->field($model, 'nama_latin')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col">

					<?= $form->field($model, 'nama_indonesia')->textInput(['maxlength' => true]) ?>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="exampleInputEmail1">Jenis Kelamin</label>
						<div class="row">
						<div class="col">
							<div class="row">
								<div class="col"><?= $form->field($model, 'is_lk')->checkbox(['value' => 1]) ?></div>
								<div class="col"><?= $form->field($model, 'is_pr')->checkbox(['value' => 1]) ?></div>
							</div>

						</div>
						
						</div>
					
					</div>
				</div>
				<div class="col">
					<?= $form->field($model, 'gambar_anatomi')->fileInput(['onchange'=>"tampilkanPreview(this,'preview')", 'class'=>'form-control']) ?>
				</div>
			</div>

			<div class="row">
				<div class="col"></div>
				<div class="col">
					<b>Preview Gambar</b><br>
					<img src="<?= $model->gambar_anatomi ?>" id="preview" width="100%"/><br/>
				</div>
			</div>


			<!-- <?= $form->field($model,'is_active')->widget(Select2::className(),[
				'data' =>  ['' => 'Pilih Status','1' => 'Aktif','0' => 'Tidak Aktif'],
				'options' => [
					'placeholder' => 'Pilih Status',
					'class'=>'form-control-sm'
				],
				'pluginOptions' => [
					'allowClear' => true
				],
			]) 
			?> -->
			<br>


			<div class="form-group d-flex float-right">      
				<!-- <button type="button" class="btn btn-default mr-2" data-dismiss="modal">Batal</button> -->
				<?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
			</div>

		<?php ActiveForm::end(); ?>
	<?php Pjax::end(); ?>

</div>

<script type="text/javascript">
	function tampilkanPreview(userfile,idpreview)
	{
		var gb = userfile.files;
		for (var i = 0; i < gb.length; i++)
		{
			var gbPreview = gb[i];
			var imageType = /image.*/;
			var preview=document.getElementById(idpreview);
			var reader = new FileReader();
			if (gbPreview.type.match(imageType))
			{
			//jika tipe data sesuai
			preview.file = gbPreview;
			reader.onload = (function(element)
			{
				return function(e)
				{
				element.src = e.target.result;
				};
			})(preview);
			//membaca data URL gambar
			reader.readAsDataURL(gbPreview);
			}
			else
			{
				//jika tipe data tidak sesuai
				alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
				document.getElementById(userfile.id).value = "";
			}
		}
	}
</script>