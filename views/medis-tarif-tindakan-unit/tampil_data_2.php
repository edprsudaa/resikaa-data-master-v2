<?php

use app\models\MedisTindakan;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

// echo '<pre>';
// print_r($data->nip);
// die();

$this->title = 'Input Unit';
$this->params['breadcrumbs'][] = ['label' => 'Tarif Tindakan Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

#Data Array
$url = \yii\helpers\Url::to(['data-tindakan']);
?>
    <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <!-- <h3 class="card-title p-3">Riwayat</h3> -->
                <table class="table">
                        <tbody>

                        <?php 
                        // $no=1;
                        
                          // foreach ($data_tindakan as $dt_tindakan) {

                        ?>
                           <!-- <form method="post" action="<?= Url::to(['medis-tarif-tindakan-unit/input-form']) ?>" name="form-mttu" class="form"> -->
                           <tr>
                            <td>
                            <?= Select2::widget([
                                    'name' => 'medis-tarif-tindakan-unit[id]',
                                    'data' => ArrayHelper::map($data_tindakan,'id','deskripsi'),
                                    'options' => [
                                      'id'=>'tindakannya',  
                                      'placeholder' => 'Select Tindakan ...',
                                        'class'=>'form-control-sm',
                                      ],
                                      'pluginOptions' => [
                                        'allowClear' => true
                                      ],
                                  ]);
                              ?>
                            </td>
                            <td>
                                <a class="btn btn-info pull-right" id="cari" style="width: 100%;">
                                  <i class="fa fa-search"></i> Tampil
                                </a>
                            </td>
                          </tr>
                          <!-- </form> -->
                        <?php 
                          // $no++;
                          // }
                        ?>
                        </tbody>
                      </table>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                      
                    <div id="tabelissue" class="card-body table-bordered table-responsive table-striped p-0" style="height: 520px;">
                      <div class="box-body" id="isiDatanya"></div>
                    </div>
                  <!-- /.tab-pane -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->

<?php 
$script = <<< JS
$('#cari').click(function(){
	var tindakannya = $("#tindakannya").val();

  if (tindakannya == "") {
				alert('Harap isi salah satu dari data yang dibutuhkan!');
				$("#tahun").focus();
				event.preventDefault();
  } else {
    // alert(jenis+merk);
    $("#loading").show();
 
    $.get('input-form',{ tindakannya : tindakannya },function(data){
      $("#isiDatanya").html(data);
			$("#loading").hide();
    });
  }
});
 
JS;
$this->registerJs($script);
?>