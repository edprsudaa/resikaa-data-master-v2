<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

// $fieldOptions1 = [
//     'options' => ['class' => 'form-group has-feedback'],
//     'inputTemplate' => "{input}<span class='glyphicon glyphicon-qrcode form-control-feedback'></span>"
// ];

// $fieldOptions2 = [
//     'options' => ['class' => 'form-group has-feedback'],
//     'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
// ];
?>


<div class="login-box">
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false,'class'=>"login100-form validate-form"]); ?>
        <div class="login-logo">
            <img src="<?= Yii::$app->request->baseUrl ?>/images/logo_login.png" width="350"/><br/>
            <!-- <a href=""><b>SURYA </b> HOMESTAY</a> -->
        </div>
        <!-- /.login-logo -->
        <div class="row">
        <div class="col-md-12">
        <div class="form-group">
        <?= $form
            ->field($model, 'username')
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('User Id'),'class'=>"form-control"]) 
        ?>           
        </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-12">
        <div class="form-group">
        <?= $form
            ->field($model, 'password')
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'),'class'=>"form-control"]) 
        ?>           
        </div>
        </div>
        </div>
 
        <div class="row">
        <div class="col-md-12">
        <div class="form-group">
                <div class="icheck-primary">
                <?= $form->field($model, 'rememberMe')->checkbox([]) ?>
                </div>
        </div>
        </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <?= Html::submitButton('Sign in', ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
        </div>
        <!-- /.col -->
        </div>

        </div>
        <!-- /.login-card-body -->
    
    <?php ActiveForm::end(); ?>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->