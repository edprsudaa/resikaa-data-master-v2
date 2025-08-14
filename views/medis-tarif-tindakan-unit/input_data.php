<?php

use app\components\Helper;
use app\models\MedisTindakan;
use app\models\PegawaiUnitPenempatan;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\web\JsExpression;

// echo '<pre>';
// print_r($data->nip);
// die();

#Data Array


?>
<div class="row">
  <div class="col-12">
    <!-- Custom Tabs -->
    <div class="card">
      <div class="card-header d-flex p-0">
        <!-- <h3 class="card-title p-3">Riwayat</h3> -->
        <h4 class="nav nav-pills p-2">
          <b>Input Data Tarif Tindakan Unit (<?= Helper::getTindakan($tindakan) ?>)</b>
        </h4>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
        
          <div id="tabelissue" class="card-body table-bordered table-responsive table-striped p-0" style="height: 420px;">
            <table class="table">
              <thead>
                <tr>
                  <!-- <form method="post" action="<?= Url::to(['medis-tarif-tindakan-unit/input-data']) ?>" name="form-mttu" class="form"> -->
                    <td colspan="4">
                      <input type="text" id="TindakanId" name="MedisTarifTindakanUnit[id]" value="<?= $tindakan ?>" hidden>
                      <?= Select2::widget([
                        'name' => 'MedisTarifTindakanUnit[unit]',
                        'data' => ArrayHelper::map($unit, 'kode', 'nama'),
                        'options' => [
                          'id' => 'UnitId',
                          'placeholder' => 'Select Unit ...',
                          'class' => 'form-control-sm'
                        ],
                        'pluginOptions' => [
                          'allowClear' => true
                        ],
                      ]);
                      ?>
                      <!-- <?= Html::dropDownList('medis-tarif-tindakan-unit[unit]', null, ArrayHelper::map($unit, 'kode', 'nama'), ['prompt' => '= Pilih Unit =', 'class' => 'form-control']); ?> -->
                    </td>
                    <td>
                      <button type="button" class="btn btn-success btn-save"><i class="fa fa-save"></i> Input Data </button>
                    </td>
                  <!-- </form> -->
                </tr>
                <tr>
                  <th>No</th>
                  <th width="40%">Tindakan</th>
                  <th width="10%">Kelas Rawat</th>
                  <th width="25%">SK Tarif</th>
                  <th width="25%">Unit</th>
                  <!-- <th>Aksi</th> -->
                </tr>
              </thead>
              <tbody>

                <?php
                $no = 1;

                foreach ($tarif_tindakan_unit as $dt_trf) {

                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= Helper::getTindakan($dt_trf['tindakan_id']) ?></td>
                    <td><?= Helper::getKelasRawat($dt_trf['kelas_rawat_kode']) ?></td>
                    <td><?= Helper::getSkTarif($dt_trf['sk_tarif_id']) ?></td>
                    <td><?= Helper::getUnitPenempatan($dt_trf['unit_id']) ?></td>
                  </tr>
                <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
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
$link='medis-tarif-tindakan-unit/tampil-data';

$this->registerJs(" 
 
     $('.btn-save').click(function(e){
            e.preventDefault();
            var tindakan_id = $('#TindakanId').val();
            var unit_id = $('#UnitId').val();
             $.ajax({
                url:'".Url::to(['input-data'])."',
                type:'post',
                data: {
                  tindakan_id : tindakan_id,
                  unit_id : unit_id
                },
                dataType:'json',
                success:function(result){
                    window.open('".Yii::$app->urlManager->createUrl($link)."', '_self');
                }
		        });
        });
");
?>