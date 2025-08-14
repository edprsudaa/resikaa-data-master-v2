<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AplikasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aplikasi';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title">Daftar <?= Html::encode($this->title) ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <p class="float-sm-right">
                                <?php 
                                    Modal::begin([
                                        'id'    => 'addModal',
                                        'title' => 'Form Tambah Aplikasi',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Aplikasi', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>
                    </div>

                    <?php Pjax::begin(['id'=>'aplikasi']); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'class' => 'yii\grid\SerialColumn'
                                ],
                                [
                                    'attribute' => 'nma',
                                    'filterInputOptions' => [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Cari Berdasarkan Nama Aplikasi...'
                                    ]
                                ],
                                // 'inf:ntext',
                                'lnk',
                                // 'kda',
                                // 'sta:boolean',
                                // 'crd',
                                // 'mdd',

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view}{update}{delete}',
                                    'buttons' => [

                                        'view' => function($id, $model) {
                            
                                            return Html::a('<span class="btn btn-sm btn-warning mr-2"><b class="fas fa-eye"></b></span>', null,
                                            [
                                                'title' => 'Detail',
                                                'data' => [
                                                    'toggle'    => 'modal',
                                                    'target'    => '#viewModal',
                                                    'id'        => $model->id,  
                                                ],
                                            ]);
                                        },

                                        'update' => function($id, $model) {
                            
                                            return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                            [
                                                'title' => 'Ubah',
                                                'data' => [
                                                    'toggle'    => 'modal',
                                                    'target'    => '#editModal',
                                                    'id'        => $model->id, 
                                                    'nama'    => $model->nma,
                                                    'deskripsi'  => $model->inf,  
                                                    'permission'  => $model->prm,  
                                                    'icon'  => $model->icn,  
                                                    'link'  => $model->lnk,  
                                                    'kode_akses'  => $model->kda,  
                                                    'status'    => $model->sta ? 'true' : 'false',
                                                ],
                                            ]);
                                        },

                                    
                                        'delete' => function ($url, $model) {
                                            return Html::button('<b class="fa fa-trash"></b>', [
                                                'class' => 'btn btn-sm btn-danger',
                                                'data'  => [
                                                    'toggle'    => 'modal',
                                                    'target'    => '#delete-modal',
                                                    'id'        => $model->id
                                                ],
                                            ]);
                                        },
                                
                                    ]
                                ],
                            ],
                            'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                            'pager' => [
                                'class' => 'yii\bootstrap4\LinkPager',
                            ]
                        ]); ?>

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Aplikasi</th>
                            <td id="nama-detail"></td>
                        </tr>
                        <tr>
                            <th>Deskripsi Aplikasi</th>
                            <td id="deskripsi-detail"></td>
                        </tr>
                        <tr>
                            <th>Link Aplikasi</th>
                            <td id="link-detail"></td>
                        </tr>
                        <tr>
                            <th>File Icon</th>
                            <td id="icon-detail"></td>
                        </tr>
                        <tr>
                            <th>Permission Nama</th>
                            <td id="permission-detail"></td>
                        </tr>
                        <tr>
                            <th>Kode Akses</th>
                            <td id="kode-detail"></td>
                        </tr>
                        <tr>
                            <th>Status Aplikasi</th>
                            <td id="status-detail"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Didaftarkan</th>
                            <td id="tanggal-detail"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Diubah</th>
                            <td id="tanggal-ubah-detail"></td>
                        </tr>
                    </thead>
                </table>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Aplikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-aplikasi-edit',
                            'options' => [
                                'data-pjax' => true,
                            ]
                        ]); ?>
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6 col-md-6">
                                        <input type="hidden" name="id" id="id">
                                        <?= $form->field($model, 'nma')->textInput(['maxlength' => true, 'id' => 'nama-edit']) ?>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 col-md-6">
                                        <?= $form->field($model, 'prm')->textInput(['maxlength' => true, 'id'=> 'permission-edit']) ?>
                                    </div>

                                    <?php // $form->field($model, 'icn')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?= $form->field($model, 'inf')->textarea(['rows' => 2, 'id'=>'deskripsi-edit']) ?>

                                    </div>
                                    <div class="col-lg-6">
                                        <?= $form->field($model, 'lnk')->textarea(['rows' => 2, 'id'=>'link-edit']) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                           <?= $form->field($model, 'kda')->textarea(['rows' => 2, 'id'=>'kode-edit']) ?>
                                    </div>
                                    
                                </div>
                                <div class="box-footer">
                                    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success btn-block btn-flat', 'id'=>'btnEdit']) ?>
                                </div>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>


<!-- delete modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>              
                <button type="submit" id="deleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>


<script>

    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#deleteBtn').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['aplikasi/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                // console.log('response : ', response.success);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    $('#delete-modal').modal('hide');       
                    $.pjax.reload('#aplikasi', {timeout:3000});   

                }else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                        html: 'Pesan : ' + '<pre>' + JSON.stringify(response.data, null, 4) + '</pre>',
                        icon    : "error",
                        allowOutsideClick: false
                    });
                }
                
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });

    }); 

    $('#editModal').on('show.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        var link = button.data('link'); 
        var deskripsi = button.data('deskripsi'); 
        var nama = button.data('nama'); 
        var permission = button.data('permission'); 
        var icon = button.data('icon'); 
        var status = button.data('status'); 
        var kode = button.data('kode_akses'); 

        console.log('status : ', status);

        $('#id').val(id);
        $('#nama-edit').val(nama);
        $('#permission-edit').val(permission);
        $('#deskripsi-edit').val(deskripsi);
        $('#kode-edit').val(kode);
        $('#link-edit').val(link);
          

    });

    $('#btnEdit').click(function(e) {

        e.preventDefault();

        var id       = $('#id').val();
        var nama     = $('#nama-edit').val();
        var permission = $('#permission-edit').val();
        var kode  = $('#kode-edit').val();
        var link  = $('#link-edit').val();
        var deskripsi  = $('#deskripsi-edit').val();

        $.ajax({
            url: '<?php echo Url::to(['aplikasi/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                nama : nama,
                permission: permission,
                kode : kode,
                link : link,
                deskripsi : deskripsi,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#aplikasi', {timeout:3000});   

                }
                else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                        timer   : 3000
                    });
                }
                
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
      
       
    });

    $("#viewModal").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data("id");
        $.ajax({
            url: '<?php echo Url::to(['aplikasi/view']) ?>' + '?id=' + id,
            type: "POST",
            data: {id: id},
            success: function(response) {
                $('#nama-detail').html(response.data.nma);
                $('#deskripsi-detail').html(response.data.inf);
                $('#link-detail').html(response.data.lnk);
                $('#icon-detail').html(response.data.icn);
                $('#permission-detail').html(response.data.lnk);
                $('#kode-detail').html(response.data.kda);
                $('#status-detail').html(response.data.sta === true ? 'Aktif' : 'Tidak Aktif');
                $('#tanggal-detail').html(response.data.crd);
                $('#tanggal-ubah-detail').html(response.data.mdd);
            }
        });
    });

    $(document).on("beforeSubmit", "form#form-aplikasi", function (e) {

        var form = $(this);
        var formData = form.serialize();       

            $.ajax({
                url: '<?php echo Url::to(['aplikasi/create']) ?>',
                type: 'post',
                data: formData,
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.status === 200) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            timer   : 3000  
                        });
                        $('#addModal').modal('hide');                       

                    }else{
                        swal.fire({
                            title   :  response.message ,
                            html: 'Pesan : ' + '<pre>' + JSON.stringify(response.data, null, 4) + '</pre>',
                            icon    : "error",
                            allowOutsideClick: false
                        });                        
                    }            
                    
                },
                error: function(xhr, status, error) {
                    // handle error response here
                    var errorMessage = xhr.responseText;
                    console.log(errorMessage); // log error message to console for debugging
                }
            });
        
    });

</script>

