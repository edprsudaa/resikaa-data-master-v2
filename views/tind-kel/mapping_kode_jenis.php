<?php

use app\models\Pegawai;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

// echo '<pre>';
// print_r($data->nip);
// die();

#Data Array
?>
<?php $form = ActiveForm::begin(['action' => 'javascript::void(0)', 'options' => ['class' => 'form', 'role' => 'form']]); ?>
    <div class="card">
      <div class="card-header d-flex p-0">
        <!-- <h3 class="card-title p-3">Riwayat</h3> -->
        <h4 class="nav nav-pills p-2">
          <b>Data Tindakan Yang Belum Ada Kode Jenis</b>
        </h4>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
              
            <div id="tabelissue" class="card-body table-bordered table-responsive table-striped p-0" style="height: 480px;">
              <table class="table">
                <thead>
                  <tr>  
                    <th>No</th>
                    <th>REFERENSI</th>
                    <th>TINDAKAN</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                $no=1;
                
                  foreach ($tindakan as $tdkn) {
                    if(empty($tdkn['kode_jenis'])) {
                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $tdkn['rumpun'] ?></td>
                    <td><?= $tdkn['deskripsi'] ?></td>
                    <td>
                        <a class="btn btn-app" id="<?= $tdkn['id'] ?>" onclick="FormMappingKodeJenis(this.id)" title='Mapping Kode Jenis'><i class='fa fa-edit'></i></a>
                    </td>
                  </tr>
                <?php 
                  $no++;
                    }
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
<!-- /.row -->
<!-- END CUSTOM TABS -->

<?php ActiveForm::end(); ?>

<div class="modal fade" id="mymodal" tabindex="false" data-keyboard='false' role="dialog" aria-labelledby="myModalLabel"></div>

<script>
function FormMappingKodeJenis(ID) {
  var ID = ID;
    $.ajax({
      url: '<?= Yii::$app->urlManager->createUrl('tind-kel/form-mapping') ?>',
      data: {
        ID: ID
      },
      // dataType: 'json',
      type: 'POST',
      success: function(output) {

        $('#mymodal').html(output);
        $('#mymodal').modal({
          backdrop: 'static',
          keyboard: false
        });

      }
    });
}
</script>