<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TindKelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tind-kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'KDKEL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KODE1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KODE2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KodeKelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Harga_Bhn')->textInput() ?>

    <?= $form->field($model, 'Js_RS')->textInput() ?>

    <?= $form->field($model, 'Js_MedRS')->textInput() ?>

    <?= $form->field($model, 'Js_MedL')->textInput() ?>

    <?= $form->field($model, 'Js_MedTL')->textInput() ?>

    <?= $form->field($model, 'Js_KSO')->textInput() ?>

    <?= $form->field($model, 'lPilih')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
