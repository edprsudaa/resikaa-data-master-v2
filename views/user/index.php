<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\components\HelperSso;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AkunAknUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Identitas Pengguna';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                        </div>
                        <div class="col">
                            <p class="float-sm-right">
                                <?php 
                                    Modal::begin([
                                        'id'    => 'addModal',
                                        'title' => 'Form Tambah Akun',
                                        'size'  => 'modal-lg',
                                        'toggleButton' => ['label' => '+ Tambah Akun', 'class' => 'btn btn-success'],
                                    ]);
                                    echo $this->render('_form', [
                                        'model' => $model
                                    ]) ;

                                    Modal::end();
                                ?>
                            </p>
                        </div>
                    </div>

                    <?php Pjax::begin(['id'=>'user']); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'userid',
                                // 'id_pegawai',
                                'username',
                                // 'password',
                                'nama',
                                // 'tanggal_pendaftaran',
                                'role',
                                // 'token_aktivasi:ntext',
                                [
                                    'attribute'=>'status',
                                    'value' => function ($model){
                                        $status = [0 => 'Aktif', 1=> 'Tidak Aktif'];
                                        return $status[$model->status];
                                    },
                                    'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'status',
                                        'data' => [0 => 'Aktif', 1=> 'Tidak Aktif'],
                                        'options' => [
                                            'placeholder' => 'Pilih...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]),
                                ],

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Aksi',
                                    'template' => '{view}{update}',
                                    'buttons' => [

                                        'view' => function($id, $model) {
                            
                                            return Html::a('<span class="btn btn-sm btn-warning mr-2"><b class="fas fa-eye"></b></span>', null,
                                            [
                                                'title' => 'Detail',
                                                'data' => [
                                                    'toggle'    => 'modal',
                                                    'target'    => '#viewModal',
                                                    'id'        => $model->userid,  
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
                                                    'id'        => $model->userid, 
                                                    'id_pegawai'=> $model->id_pegawai,
                                                    'username'  => $model->username,
                                                    'nama'      => $model->nama,
                                                    'role'      => $model->role,
                                                    'status'      => $model->status,
                                                ],
                                            ]);
                                        },
                                
                                    ]
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Reset Password',
                                    'headerOptions' => ['style' => 'color:#337ab7;text-align: center;min-width: 10px;'],
                                    'options' => ['style' => 'width:70px;text-align: center'],
                                    'template' => '{reset}',
                                    'buttons' => [

                                        'reset' => function ($url, $model) {
                                            return Html::button('<b class="fa fa-spinner"></b>', [
                                                'class' => 'btn btn-sm btn-info',
                                                'data'  => [
                                                    'toggle'    => 'modal',
                                                    'target'    => '#reset-modal',
                                                    'id'        => $model->userid,
                                                    'username'        => $model->username,
                                                ],
                                            ]);
                                        },

                                    ],
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
                            <th>Kode Pegawai</th>
                            <td id="kode-detail"></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td id="username-detail"></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td id="nama-detail"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Pendaftaran</th>
                            <td id="tanggal-detail"></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td id="role-detail"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="status-detail"></td>
                        </tr>
                        <tr>
                            <th>Diubah Pada <br> User Id</th>
                            <td id="diubah-pada-detail"></td>
                        </tr>
                        <tr id="column-tanggal-nonaktif" style="display:none">
                            <th>Tanggal Non Aktif</th>
                            <td id="tanggalNonAktif"></td>
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

<div class="modal fade" id="reset-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="username_reset">
                Apakah Anda yakin ingin Reset Password Akun ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>              
                <button type="submit" id="resetBtn" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </div>
</div>


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Akun User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-user-edit',
                            'options' => [
                                'data-pjax' => true,
                            ]
                        ]); 

                        $dataPegawai = HelperSso::getDataPegawai();
                        
                        ?>
                            <div class="card card-body">
                               <div class="col-lg-12">
                                    <input type="hidden" name="id" id="id">
                                    <?= $form->field($model, 'id_pegawai')->widget(Select2::classname(), [
                                        'data' => \yii\helpers\ArrayHelper::map($dataPegawai, 'pegawai_id', 'nama_lengkap'),
                                        'language' => 'en',
                                        'options' => ['placeholder' => 'Pilih Pegawai','id'=>'pegawai_id_edit', 'disabled' => true],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ])->label('Nama Pegawai'); ?>
                                </div>
                                
                                <div class="col-lg-12">
                                    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username Berdasarkan Nip', 'readonly' => true ,'id'=>'username_edit']) ?>
                                </div>

                                <div class="col-lg-12">
                                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama Lengkap','id'=>'nama_lengkap_edit']) ?>
                                </div>

                                <div class="col-lg-12">
                                    <?= $form->field($model, 'role')->widget(Select2::classname(), [
                                        'data' => HelperSso::TypeUser,
                                        'language' => 'en',
                                        'options' => ['placeholder' => 'Pilih Role', 'id'=>'role_edit'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]); ?>
                                </div>
                                <div class="col-lg-12">
                                    <?= 
                                        $form->field($model, 'status')->widget(Select2::classname(), [
                                            'data'    => ['0' => 'Aktif', '1' => 'Tidak Aktif'],
                                            'options' => [
                                                'placeholder' => 'Pilih...',
                                                'id'    =>'status_edit'
                                            ],
                                            ]); 
                                    ?>
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

<script>
    $("#viewModal").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data("id");
        $.ajax({
            url: '<?php echo Url::to(['user/view']) ?>' + '?id=' + id,
            type: "POST",
            data: {id: id},
            success: function(response) {
                console.log('response : ', response);
                $('#kode-detail').html(response.data.id_pegawai);
                $('#nama-detail').html(response.data.nama);
                $('#username-detail').html(response.data.username);
                $('#tanggal-detail').html(response.data.tanggal_pendaftaran);
                $('#role-detail').html(response.data.role);

                if(response.data.status == 0){
                    $('#status-detail').html('<div class="badge badge-sm badge-success">AKTIF</div>');
                }else{
                    $('#status-detail').html('<div class="badge badge-sm badge-danger">TIDAK AKTIF</div>');
                }

               $('#diubah-pada-detail').html(response.data.updated_at == null ? '-' : response.data.updated_at + '<br>' + response.data.updated_by ); 

                if(response.data.tanggal_nonaktif == null){
                    $('#tanggalNonAktif').html('-');
                    $("#column-tanggal-nonaktif").css({ display: "none" });
                }else{
                    $('#tanggalNonAktif').html(response.data.tanggal_nonaktif);
                    $('#column-tanggal-nonaktif').removeAttr("style");

                }
                
               
            }
        });
    });

    $(document).on("beforeSubmit", "form#form-user", function (e) {

        var form = $(this);
        var formData = form.serialize();       

            $.ajax({
                url: '<?php echo Url::to(['user/create']) ?>',
                type: 'post',
                data: formData,
                success: function(response){
                    console.log('hasil : ',response);

                    if (response.status === 200) {                    
                        swal.fire({
                            title   : response.message,
                            icon    : "success",
                            // timer   : 3000  
                        });
                        $('#addModal').modal('hide');  
                        $("#form-user").trigger("reset"); 
                        $.pjax.reload('#user', {timeout:5000});                         

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

    $('#editModal').on('show.bs.modal',function(e){
         
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        var id_pegawai = button.data('id_pegawai'); 
        var username = button.data('username'); 
        var nama = button.data('nama'); 
        var role = button.data('role'); 
        var status = button.data('status'); 

        $('#id').val(id);
        $('#pegawai_id_edit').val(id_pegawai).trigger('change');
        $('#role_edit').val(role).trigger('change');
        $('#status_edit').val(status).trigger('change');
        $('#username_edit').val(username);
        $('#nama_lengkap_edit').val(nama);          

    });

    $('#btnEdit').click(function(e) {

        e.preventDefault();

        var id       = $('#id').val();
        var nama     = $('#nama_lengkap_edit').val();
        var role    = $('#role_edit').val();
        var status  = $('#status_edit').val();

        $.ajax({
            url: '<?php echo Url::to(['user/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                nama : nama,
                role: role,
                status : status,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        // timer   : 3000  
                    });
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#user', {timeout:4000});   

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

    $('#reset-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        var username = button.data('username'); 
        $('#id').val(id);        
        $('#username_reset').val(username);        
    });

     $('#resetBtn').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();
        var username  = $('#username_reset').val();

        $.ajax({
            url: '<?php echo Url::to(['user/reset-password/']) ?>' + '?id=' + id,
            type: 'post', 
            data : {
                username : username
            },
            success: function(response) {
                // console.log('response : ', response.success);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        // timer   : 3000  
                    });
                    $('#reset-modal').modal('hide');       
                    $.pjax.reload('#user');   

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
    
</script>

