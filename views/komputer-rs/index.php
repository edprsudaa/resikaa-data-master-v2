<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\Aplikasi;
use app\models\AkunAknUser;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\components\HelperSso;
use app\models\PegawaiUnitPenempatan;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AksesUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$unit = PegawaiUnitPenempatan::find()->where(['aktif'=> 1])->orderBy(['nama'=> SORT_ASC])->all();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5> <?= $this->title = 'Daftar Komputer RSUD AA';?></h5>
                    
                </div>
                <div class="card-body">
                   
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                    <hr>
                
                    <?php Pjax::begin(['id'=>'komputer-rs']); ?>
                        <div class="table-responsive">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    // [
                                    //     'attribute' => 'id',
                                    //     // 'headerOptions' => ['style' => 'width:100px'],
                                    // ],
                                    [
                                        'attribute' => 'kode_unit',
                                        // 'headerOptions' => ['style' => 'width:100px'],
                                    ],
                                    [
                                        'attribute' => 'nama_ruangan',
                                        'value' => 'unitPenempatan.nama',
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'nama_ruangan',
                                            'data' =>  ArrayHelper::map($unit,'kode','nama'),
                                            'options' => [
                                                'placeholder' => 'Pilih Berdasarkan Nama Ruangan...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),

                                    ],
                                    [
                                        'attribute' => 'ip_address',
                                        // 'headerOptions' => ['style' => 'width:100px'],
                                    ],
                                    [
                                        'attribute' => 'mac_address',
                                        // 'headerOptions' => ['style' => 'width:100px'],
                                    ],
                                    
                                    // [
                                    //     'label' => 'Nama Ruangan',
                                    //     'attribute' => 'unitPenempatan.nama',
                                    //     // 'headerOptions' => ['style' => 'width:100px'],
                                    // ],
                                    [
                                        'attribute' => 'keterangan',
                                    ],
                                    [
                                        'attribute' => 'notifikasi_status',
                                        'format' => 'raw',
                                        'headerOptions' => ['style' => 'width:120px'],
                                        'value' => function ($model) {
                                            // Tentukan kelas ikon berdasarkan status notifikasi
                                            $iconClass = $model->is_notifikasi ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-muted';
                                            $title = $model->is_notifikasi ? 'Aktif' : 'Nonaktif';
                                    
                                            // Buat tombol dengan atribut data untuk AJAX
                                            return Html::button(
                                                '<span class="' . $iconClass . '"></span>',
                                                [
                                                    'class' => 'toggle btn btn-sm', // Tambahkan class `btn btn-sm` untuk styling
                                                    'data-id' => $model->id,
                                                    'data-status' => $model->is_notifikasi,
                                                    'title' => $title,
                                                ]
                                            );
                                        },
                                    ],
                                    [
                                        'headerOptions' => ['style' => 'min-width: 120px;'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'contentOptions' => ['style' => 'text-align: center;'],
                                        'header' => 'Aksi',
                                        'template' => '{update}{delete}',
                                        // 'template' => '{view}{update}{delete}',
                                        'buttons' => [                        
                                            
                                            'update' => function($id, $model) {
                                
                                                return Html::a('<span class="btn btn-sm btn-default mr-2"><b class="fas fa-pencil-alt"></b></span>', null,
                                                [
                                                    'title' => 'Ubah',
                                                    'data' => [
                                                        'toggle'    => 'modal',
                                                        'target'    => '#editModal',
                                                        'id'        => $model->id, 
                                                        'kode_unit'=> $model->kode_unit,
                                                        'ip_address'  => $model->ip_address,
                                                        'mac_address'      => $model->mac_address,
                                                        'nama_ruangan'      => $model->nama_ruangan,
                                                        'keterangan'      => $model->keterangan,
                                                        'notifikasi_status'      => $model->is_notifikasi,
                                                    ],
                                                ]);
                                            },

                                            'delete' => function ($id, $model) {
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

                        </div>
                    <?php Pjax::end(); ?>
                       
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Komputer RS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

             <div class="modal-body">
                <div class="row">
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-komputer-rs',
                            'options' => [
                                'data-pjax' => true,
                            ]
                        ]); 
                        ?>

                        <input type="hidden" id="id">
                        <?= $form->field($model, 'kode_unit')->textInput(['maxlength' => true, 'id' => 'kode-unit-edit', 'disabled'=>true]) ?>
                         <?= $form->field($model, 'nama_ruangan')->widget(Select2::classname(), [
                            'data' =>  ArrayHelper::map($unit,'kode','nama'),
                            'options' => ['placeholder' => 'Pilih Ruangan...','id'=>'nama-edit', 'disabled'=>true],
                            'pluginOptions' => [
                            'allowClear' => false
                            ],
                        ]);
                        ?>
                        <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true, 'id' => 'ip-edit']) ?>
                        <?= $form->field($model, 'mac_address')->textInput(['maxlength' => true, 'id' => 'mac-edit']) ?>
                       
                        <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true, 'id' => 'keterangan-edit']) ?>
                        
                        

                        <div class="col-lg-2">
                            <div class="box-footer">
                                <label for="" style="color:white">s</label>
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
                <input type="hidden" id="idKomputer">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>              
                <button type="submit" id="btnDelete" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("beforeSubmit", "form#form-komputer-rs", function (e) {

        var form = $(this);
        var formData = form.serialize();       

            $.ajax({
                url: '<?php echo Url::to(['komputer-rs/create']) ?>',
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
        var kode_unit = button.data('kode_unit'); 
        var ip_address = button.data('ip_address'); 
        var mac_address = button.data('mac_address'); 
        var nama_ruangan = button.data('nama_ruangan'); 
        var keterangan = button.data('keterangan'); 

        $('#id').val(id);
        $('#kode-unit-edit').val(kode_unit);
        $('#ip-edit').val(ip_address);
        $('#mac-edit').val(mac_address);
        $('#nama-edit').val(nama_ruangan).trigger('change');
        $('#keterangan-edit').val(keterangan);
    });

    $('#btnEdit').click(function(e) {

        e.preventDefault();

        var id       = $('#id').val();
        var kode_unit     = $('#kode-unit-edit').val();
        var ip_address    = $('#ip-edit').val();
        var mac_address  = $('#mac-edit').val();
        var nama_ruangan  = $('#nama-edit').val();
        var keterangan  = $('#keterangan-edit').val();

        $.ajax({
            url: '<?php echo Url::to(['komputer-rs/update']) ?>' + '?id=' + id,
            type: 'post',          
            data: {
                kode_unit : kode_unit,
                ip_address: ip_address,
                mac_address : mac_address,
                nama_ruangan : nama_ruangan,
                keterangan : keterangan,
            },
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                    });
                    $('#editModal').modal('hide');                                 
                    $.pjax.reload('#komputer-rs',{timeout:3000});   

                }
                else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                    });
                }
                
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
      
       
    });

    $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#idKomputer').val(id);        
    });

    $('#btnDelete').click(function(e) {
        e.preventDefault();

        var id  = $('#idKomputer').val();

        $.ajax({
            url: '<?php echo Url::to(['komputer-rs/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                console.log('response : ', response);

                if (response.status === 200) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success"
                    });
                    $('#delete-modal').modal('hide'); 
                    $.pjax.reload('#komputer-rs', {timeout:3000});     

                }else{
                    swal.fire({
                        title   : response.message,
                        icon    : "error",
                        // timer   : 3000
                    });
                }
                
            },
            error: function() {
                alert('Terjadi kesalahan saat menghapus data.');
            }
        });

    }); 

    $(document).on('click', '.toggle', function (e) {
    e.preventDefault(); // Cegah perilaku default

    var link = $(this);
    var id = link.data('id'); // Ambil ID dari atribut data
    var currentStatus = link.data('status'); // Ambil status saat ini

    $.ajax({
        url: '<?php echo Url::to(['komputer-rs/toggle']) ?>', // Pastikan URL sesuai dengan action di controller
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if (response.status === 200) {
                // Update ikon dan status
                var newStatus = response.is_notifikasi;
                var iconClass = newStatus ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-muted';
                var title = newStatus ? 'Aktif' : 'Nonaktif';

                link.html('<span class="' + iconClass + '"></span>'); // Update ikon
                link.data('status', newStatus); // Update status di atribut data
                link.attr('title', title); // Update tooltip

                // Tampilkan notifikasi sukses
                swal.fire({
                    title: response.message,
                    icon: "success",
                });
            } else {
                // Tampilkan notifikasi error
                swal.fire({
                    title: response.message || 'Gagal memperbarui status notifikasi.',
                    icon: "error",
                });
            }
        },
        error: function () {
            swal.fire({
                title: 'Terjadi kesalahan saat memperbarui status notifikasi.',
                icon: "error",
            });
        },
    });
});
</script>

