<?php

use app\components\Helper;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\RiwayatDiklat */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table tr th td {
        font-size: 12px;
    }

    th, td {
    padding: 5px;
    text-align: left;
    }

    .table-with-border {
        border-collapse: collapse;
        padding: 10px 5px;
    }

    .table-with-border-header {
        border: 2px solid black;
    }

    .table-with-border-body {
        border-top: none;
        border-bottom: none;
        border-right: 2px solid black;
        border-left: 2px solid black;
    }

    .table-with-border-footer {
        border: 2px solid black;
    }

    .font-label {
        max-width: 10%;
        vertical-align: text-top;
    }

    .font-isi {
        max-width: 38%;
        vertical-align: text-top;
    }

    .font-colon {
        max-width: 2%;
        text-align: left;
        vertical-align: text-top;
    }

    .table-header {
        padding: 0px;
        min-height: 100px;
        border: none;
        line-height: 1;
        margin-top: -10px;
    }

    .table-header td {
        word-wrap: break-word;
        vertical-align: text-top;
    }
</style>

<div class="modal-dialog modal-lg" role="document" style="margin-top: 0px;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="formModalLabel"> Form Mapping Kode Jenis </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>

        <br/>
        <?php $form = ActiveForm::begin([
            'id'=>'TINDKEL',
            'action'=>'javascript::void(0)',
            'options'=>['enctype' => 'multipart/form-data', 'class'=>'form form-mapping-kode-jenis', 'role'=>'form']
            ]); 
        ?>

        <div class="form-group">
            <?php
                echo $form->field($model, 'id')->label(false)->hiddenInput(['maxlength' => true]); 
            ?>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>                  
                    <tr>
                        <th>KELOMPOK</th>
                        <th colspan="2">TINDAKAN</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= Helper::getTindakan($dt_tindakan['parent_id']) ?></td>
                        <td><p id="p1"><?= $dt_tindakan['deskripsi'] ?></p></td>
                        <td width="5%"><button onclick="copyToClipboard('p1')">Copy</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <div class="form-group row col-sm-12">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">TindKel SQL SERVER</label>
                    <div class="col-sm-9">
                        <?php
                            echo $form->field($model,'kode_jenis')->label(false)->widget(Select2::className(),[
                                'data' =>  ArrayHelper::map($data_tindkel,'id','name'),
                                'options' => [
                                    'id'=>'pegawai-kode_dokter_maping_simrs',
                                    'placeholder' => '== Pilih Tindakan SIMRS OLD ==',
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
                <button type="button" class="btn btn-success btn-save"><i class="fa fa-save"></i> SIMPAN </button>
                <button type="button" data-dismiss="modal" class="btn btn-danger right"> Batal </button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>



    </div>
</div>

<?php

//$idpeg = $tindakan['id'];
$link ='tind-kel/mapping-kode-jenis';

$this->registerJs(" 
 
     $('.btn-save').click(function(e){
            e.preventDefault();
            var btn=$('.btn-save');
            var Data = $('#TINDKEL').serialize();
            btn.html('<i class=\'fa fa-refresh fa-spin fa-fw\'></i> Menyimpan ...').attr('disabled',true);
             $.ajax({
                url:'".Url::to(['save'])."',
                type:'post',
                data: Data,
                dataType:'json',
                success:function(result){
                    if(result.status=='true'){
                        console.log(result.msg);
                        $('#mymodal').modal('hide');
                        window.open('".Yii::$app->urlManager->createUrl($link)."', '_self');
                    }else{
                        console.log(result.msg);
                    }
                    btn.html('<i class=\'md md-save\'></i> Tersimpan').removeAttr('disabled');
                }
		    });
        });  
        
        
        function copyToClipboard(elementId) {

            // Create a 'hidden' input
            var aux = document.createElement('input');
          
            // Assign it the value of the specified element
            aux.setAttribute('value', document.getElementById(elementId).innerHTML);
          
            // Append it to the body
            document.body.appendChild(aux);
          
            // Highlight its content
            aux.select();
          
            // Copy the highlighted text
            document.execCommand('copy');
          
            // Remove it from the body
            document.body.removeChild(aux);
          
          }
");
