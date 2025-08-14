<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\MedisIcd10cm */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="medis-icd10cm-form">

    <?php $form = ActiveForm::begin(
        [
            'id' => $model->formName(),
            'action' => 'javascript::void(0)',
            'options' => [
                'class' => 'form',
                // 'role' => 'form'
            ],
        ]
    ); ?>

    <?php
    if (!$model->isNewRecord) {
    ?><input type="hidden" name="id" value="<?php echo $model->id; ?>"><?php
                                                                    }
                                                                        ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::class, [
        'data' =>  ArrayHelper::map($icd10cm, 'id', 'rumpun'),
        //'data' =>  ArrayHelper::map($tindakan,'id','deskripsi'),
        'options' => [
            'id' => 'icd10cm',
            'placeholder' => 'Pilih ICD 10 CM',
            'class' => 'form-control-sm'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?php  

    if(!$model->isNewRecord) {
        echo $form->field($model, 'aktif')->widget(Select2::class, [
            'data' =>  ['' => 'Pilih Status', '1' => 'Aktif', '0' => 'Tidak Aktif'],
            'options' => [
                'id' => 'Status',
                'placeholder' => 'Pilih Status',
                'class' => 'form-control-sm'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    }
    
    ?>

    <div class="form-group float-sm-right">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Tambah' : 'Update',
            [
                'class' => $model->isNewRecord ? 'btn btn-success btn-submit' : 'btn btn-primary btn-submit',
                'status' => $model->isNewRecord ? 'Ditambah' : 'Diperbarui',
            ]
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$this->registerJs("
$('#" . $model->formName() . "').on('beforeSubmit',function(e){
    e.preventDefault();
    var btn=$('.btn-submit');
    var status = btn.attr('status');
    $.ajax({
        url:'" . Url::to(['save-data']) . "',
        type:'post',
        dataType:'json',
        data:$(this).serialize(),
        // contentType: false,
        // processData: false,
        success:function(result){
            console.log(result);
            if(result.status) {
                $('#detailModal').modal('hide');
                // console.log('success');
                // console.log(result);
                showAlert('Data ICD-10 berhasil ' + status, 'success');
                $.pjax.reload({
                    container:'#pjax-gridview', 
                    timeout: false
                });
            }else{
                if(typeof result.msg=='object'){
                    $.each(result.msg,function(i,v){
                        console.log(v);
                    });
                }else{
                    console.log(result.msg);
                }
            }
        },
        error:function(xhr,status,error){
            console.log(error);
        }
    });
}).submit(function(e){
    e.preventDefault();
});
");
