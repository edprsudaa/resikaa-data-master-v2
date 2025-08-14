<?php

use app\models\MedisTindakan;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

// echo '<pre>';
// print_r($data->nip);
// die();

$this->title = 'Input Tarif Tindakan Unit';
$this->params['breadcrumbs'][] = ['label' => 'Tarif Tindakan Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

#Data Array
$url = \yii\helpers\Url::to(['data-tindakan']);
?>

<style>
  div.table-wrapper {
  border: 1px solid #ccc;
  height: 100px;
  width: 100%;
  overflow-y: auto;
 }
 
 table {
   width: 100%;
   border-collapse: collapse;
 }
 table thead tr th {
   text-align: left;
   position: sticky;
   top: 0px;
   background-color: #666;
   color: #fff;
 }

 table td a{
    text-decoration: none;
    color: black;
}

table th,td{
    padding: 5px;
}
.delete{
    color: red;
}

.delete:hover{
	cursor: pointer;
}

 .container{
    margin: 0 auto;
}
</style>

    <div class="card card-outline card-primary">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <?= Select2::widget([
                  'name' => 'MedisTarifTindakanUnit[id]',
                  'data' => $data_tindakan,
                  // 'data' => ArrayHelper::map($data_tindakan,'id','deskripsi'),
                  'options' => [
                    'id'=>'tindakannya', 
                    'onchange' =>'Tampilkan()',
                    'placeholder' => 'Select Tindakan ...',
                      'class'=>'form-control-sm',
                    ],
                    'pluginOptions' => [
                      'allowClear' => true
                    ],
                ]);
            ?>
          </div>
          <div class="col-sm-3">
            <?= Select2::widget([
              'name' => 'MedisTarifTindakanUnit[unit]',
              'data' => ArrayHelper::map($unit, 'kode', 'nama'),
              'options' => [
                'id' => 'unitId',
                'onchange' =>'TampilkanByUnit()',
                'placeholder' => 'Select Unit ...',
                'class' => 'form-control-sm'
              ],
              'pluginOptions' => [
                'allowClear' => true
              ],
            ]);
            ?>
          </div>
          <div class="col-sm-3">
            <?= Select2::widget([
              'name' => 'kelas[]',
              // 'name' => 'MedisTarifTindakanUnit[kelas]',
              // 'name' => 'MedisTarifTindakanUnit[kelas]',
              'data' => ArrayHelper::map($kelas, 'kode', 'nama'),
              'options' => [
                'id' => 'kelasId',
                'placeholder' => 'Select Kelas Rawat ...',
                'class' => 'form-control-sm',
                'onchange' =>'TampilkanByUnitKelas()',
              ],
              'pluginOptions' => [
                // 'tags' => $row,
                'allowClear' => true,
                'multiple' => true
              ],
            ]);
            ?>
          </div>
          <div class="col-sm-1">
            <button type="button" class="btn btn-success btn-save"><i class="fa fa-save"></i> Simpan </button>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
      <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card card-outline card-primary">
              <div class="card-header d-flex p-0">
              <div class="card-body">
                <div class="tab-content">
                  <div id="tabelissue" class="table-bordered table-responsive table-striped p-0" style="height: 420px;">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th width="40%">Tindakan</th>
                        <th width="10%">Kelas Rawat</th>
                        <!-- <th width="25%">SK Tarif</th> -->
                        <th width="25%">Unit</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="isiDatanya"></tbody>
                  </table>
                  <div id='loading' style='display:none' align="center">
                      <img src='<?= Yii::$app->request->baseUrl ?>/images/loading.gif' width="300px"/>
                  </div>
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


<script src="<?= Yii::$app->request->baseUrl ?>/js/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
function Tampilkan() {
    $('#loading').show();
    $('#isiDatanya').html('');

    var tindakannya = $("#tindakannya").val();

    // alert(tindakannya);

    $.ajax({
        url:'<?php echo Url::toRoute('input-form'); ?>',
        type: 'post',
        dataType: 'json',
        data: {
            'tindakannya' : $("#tindakannya").val(),
        },
        success: function(result){
            console.log(result);
            if (result.con == true) {
                var tarif_tindakan_unit = result.result;
                var no = 1;
                $.each(tarif_tindakan_unit, function (i, data) {
                    $('#loading').hide();
                    $('#isiDatanya').append(`
                        <tr>
                            <td>`+ no +`</td>
                            <td>`+ data.deskripsi +`</td>
                            <td>`+ data.kr_nama +`</td>
                            <td>`+ data.unt_nama +`</td>
                            <td><button class='btn btn-danger deleteData' id='`+ data.id +`'><i class="fa fa-trash"></i></button></td>
                        </tr>
                    `);
                    no++;
                });
            } else {
                $('#loading').hide();
                // alert(result.message);
                // $('isiDatanya').html(`
                // <tr>
                //     <td colspan="5">`+result.message+`</td>
                // </tr>
                // `)
            }
        },
        error: function (error) {
            // alert('Terjadi kesalahan pada Koneksi database, Silahkan Coba lagi!');
            $('#loading').hide();
        }
    });
}

function TampilkanByUnit() {

    // alert('ok');
    $('#loading').show();
    $('#isiDatanya').html('');

    var tindakannya = $("#tindakannya").val();
    var unitId = $("#unitId").val();

    // alert(unitId);
    $.ajax({
        url:'<?php echo Url::toRoute('input-form-by-unit'); ?>',
        type: 'post',
        dataType: 'json',
        data: {
            'tindakannya' : $("#tindakannya").val(),
            'unitId' : $("#unitId").val(),
        },
        success: function(result){
           console.log('by unit :' ,result);
            if (result.con == true) {
                var tarif_tindakan_by_unit = result.result;
                var no = 1;
                $.each(tarif_tindakan_by_unit, function (i, data) {
                    $('#loading').hide();
                    $('#isiDatanya').append(`
                        <tr>
                            <td>`+ no +`</td>
                            <td>`+ data.deskripsi +`</td>
                            <td>`+ data.kr_nama +`</td>
                            <td>`+ data.unt_nama +`</td>
                            <td><button class='btn btn-danger deleteData' id='`+ data.id +`'><i class="fa fa-trash"></i></button></td>
                        </tr>
                    `);
                    no++;
                });
            } else {
                $('#loading').hide();
                // alert('gagal');
                // alert(result.message);
                // $('isiDatanya').html(`
                // <tr>
                //     <td colspan="5">`+result.message+`</td>
                // </tr>
                // `)
            }
        },
        error: function (error) {
            // alert('Terjadi kesalahan pada Koneksi database, Silahkan Coba lagi!');
            $('#loading').hide();
        }
    });
}

function TampilkanByUnitKelas() {

  // alert('ok');
    $('#loading').show();
    $('#isiDatanya').html('');

    var tindakannya = $("#tindakannya").val();
    var unitId = $("#unitId").val();
    var kelasId = $("#kelasId").val();

    // alert(kelasId);

    // console.log('kelas', kelasId);

    // alert(unitId);
    $.ajax({
        url:'<?php echo Url::toRoute('input-form-by-unit-kelas'); ?>',
        type: 'post',
        dataType: 'json',
        data: {
            'tindakannya' : $("#tindakannya").val(),
            'unitId' : $("#unitId").val(),
            'kelasId' : $("#kelasId").val(),
        },
        success: function(result){
           console.log('by unit kelas :' ,result);
            if (result.con == true) {
                var tarif_tindakan_by_unit_kelas = result.result;
                var no = 1;
                $.each(tarif_tindakan_by_unit_kelas, function (i, data) {
                    $('#loading').hide();
                    $('#isiDatanya').append(`
                        <tr>
                            <td>`+ no +`</td>
                            <td>`+ data.deskripsi +`</td>
                            <td>`+ data.kr_nama +`</td>
                            <td>`+ data.unt_nama +`</td>
                            <td><button class='btn btn-danger deleteData' id='`+ data.id +`'><i class="fa fa-trash"></i></button></td>
                        </tr>
                    `);
                    no++;
                });
            } else {
                $('#loading').hide();
                // alert('gagal');
                // alert(result.message);
                // $('isiDatanya').html(`
                // <tr>
                //     <td colspan="5">`+result.message+`</td>
                // </tr>
                // `)
            }
        },
        error: function (error) {
            // alert('Terjadi kesalahan pada Koneksi database, Silahkan Coba lagi!');
            $('#loading').hide();
        }
    });
}



$('.btn-save').click(function(e){
    $('#loading').show();
    $('#isiDatanya').html('');

    var tindakan_id = $("#tindakannya").val();
    var unit_id = $('#unitId').val();
    var kelas = $('#kelasId').val();

    if (tindakan_id == "" || unit_id == "" || kelas =="") {
          // alert('Harap Pilih Tindakan, Unit, dan Kelas Terlebih Dahulu!');
          swal.fire({
              title: "Harap Pilih Tindakan, Unit, dan Kelas Terlebih Dahulu!",
              icon: "warning",
          });        
          
          $("#tindakannya").focus();
          $('#loading').hide();
    }
    else {
      $.ajax({
          url:'<?php echo Url::toRoute('input-data'); ?>',
          type: 'post',
          dataType: 'json',
          data: {
              tindakan_id : tindakan_id,
              unit_id : unit_id,
              kelas : kelas,
          },
          success: function(result){
            console.log('hasil : ',result.con);

            if(result.con === false){
               swal.fire({
                title: "Maaf, Tindakan medis untuk kelas yang dipilih belum tersedia pada tarif tindakan",
                icon: "error",
              });

              $('#tindakannya').val(tindakan_id);          
              Tampilkan();
            }else{
              swal.fire({
                title: "Berhasil Input Tarif Tindakan Unit",
                icon: "success",
              });
              $('#tindakannya').val(tindakan_id);          
              Tampilkan();
            }
           
              
          },
          error: function (error) {
              // alert('Terjadi kesalahan pada Koneksi database, Silahkan Coba lagi!');
              $('#loading').hide();
          }
      });
  }
});

$(document).on("click", ".deleteData", function() { 
  var id = $(this).attr('id');
	var confirmDelete = confirm("Apakah Yakin Akan Menghapus Data Ini! ");
	if(confirmDelete){
    $.ajax({
        url:'<?php echo Url::toRoute('delete-data'); ?>',
        type: 'post',
        dataType: 'json',
        data: {
          id : id,
        },
        success: function(result){
          $('#'+id).closest('tr').css('background','tomato');
          $('#'+id).closest('tr').fadeOut(800,function(){
              $(this).remove();
          });
          // Tampilkan();
        },
        error: function (error) {
            alert('Terjadi kesalahan pada Koneksi database, Silahkan Coba lagi!');
            $('#loading').hide();
        }
    });
    }
	});
</script>

<?php 
// $script = <<< JS
// $('#cari').click(function(){
//   $('#isiDatanya').html('');

// 	var tindakannya = $("#tindakannya").val();

//   if (tindakannya == "") {
// 				alert('Harap isi salah satu dari data yang dibutuhkan!');
// 				$("#tahun").focus();
// 				event.preventDefault();
//   } else {
//     // alert(jenis+merk);
//     // $("#loading").show();
 
//     $.get('input-form',{ tindakannya : tindakannya },function(data){
//       $("#isiDatanya").html(data);
// 			// $("#loading").hide();
//     });
//   }
// });
 
// JS;
// $this->registerJs($script,View::POS_END);
?>