<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use \yii\bootstrap\Modal;
use \demogorgorn\ajax\AjaxSubmitButton;
use \yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model app\models\RiwayatDiklat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-dialog modal-lg" role="document" style="margin-top: 0px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="formModalLabel"> Form Download Format Import </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>


        <form method="post" action="<?= Url::to(['medis-tarif-tindakan/export']) ?>" name="form-export" class="form">
            <div class="form-group">
                <div class="form-group row col-sm-12">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">SK Tarif</label>
                    <div class="col-sm-9">
                        <?= Select2::widget([
                                'name' => 'sktarif',
                                'data' =>  ArrayHelper::map($sk_tarif,'id','nomor'),
                                'options' => [
                                    'id'=>'SkTarif',
                                    'placeholder' => '== Pilih SK Tarif ==',
                                    'class'=>'form-control-sm'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) 
                        ?>
                    </div>
                </div>
                <div class="form-group row col-sm-12">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kelas Rawat</label>
                    <div class="col-sm-9">
                        <?= Select2::widget([
                                'name' => 'kelasrawat',
                                'data' =>  ArrayHelper::map($kelas_rawat,'kode','nama'),
                                'options' => [
                                    'id'=>'KelasRawat',
                                    'placeholder' => '== Pilih Kelas Rawat ==',
                                    'class'=>'form-control-sm'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) 
                        ?>
                    </div>
                </div>
                <div class="form-group row col-sm-12">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Tindakan</label>
                    <div class="col-sm-9">
                        <?= Select2::widget([
                                'name' => 'tindakan',
                                'data' =>  ArrayHelper::map($tindakan,'id','rumpun'),
                                'options' => [
                                    'id'=>'Tindakan',
                                    'placeholder' => '== Pilih Tindakan ==',
                                    'class'=>'form-control-sm'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) 
                        ?>
                    </div>
                </div>
            </div>
       

        <div class="modal-footer">
            <div class="row" align="right">
            <?= Html::submitButton('<i class="far fa-file-excel"></i> Export Excel', ['class' => 'btn btn-success']) ?> &nbsp; &nbsp;
            <button type="button" data-dismiss="modal" class="btn btn-danger right"> Close </button>
            <?= Html::hiddenInput(Yii::$app->request->csrfParam,Yii::$app->request->csrfToken) ?>   
            </div>
        </div>

        </form>



    </div>
</div>
