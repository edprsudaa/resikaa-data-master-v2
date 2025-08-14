<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use app\components\Helper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisAnatomiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medis Anatomi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                        </div>
                        <div class="col-sm-6">
                            <p class="float-sm-right">
                                <button type="button" class="btn btn-success" id="buttonAdd" >
                                    <i class="fa fa-plus"></i> Tambah Anatomi
                                </button>
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive">
                    <?php Pjax::begin(['id'=>'anatomi']); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                            //'id_anatomi',
                            //'parent_id',
                                [
                                    'headerOptions'=>['style'=>'min-width:320px'],    
                                    'attribute' => 'Referensi',
                                    'value' => function ($model){
                                        return Helper::getAnatomi($model->parent_id);
                                    },
                                    'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'parent_id',
                                        'data' => ArrayHelper::map($anatomiInduk, 'id_anatomi', 'rumpun'),
                                        'options' => [
                                            'placeholder' => 'Pilih...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]),
                                ],
                            //'created_by',
                            //'created_at',
                            //'updated_by',
                            //'updated_at',
                            //'is_deleted',
                            //'deleted_by',
                            //'deleted_at',
                            'nama_latin',
                            'nama_indonesia',
                            //    'gambar_anatomi',
                                [
                                    'attribute'=>'is_pr',
                                    'value' => function ($model){
                                        $status = [0 => 'Tidak', 1 => 'Ya'];
                                        return $status[$model->is_pr];
                                    },
                                    'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'is_pr',
                                        'data' => [1 => 'Ya', 0 => 'Tidak'],
                                        'options' => [
                                            'placeholder' => 'Pilih...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]),
                            ],
                                [
                                    'attribute'=>'is_lk',
                                    'value' => function ($model){
                                        $status = [0 => 'Tidak', 1 => 'Ya'];
                                        return $status[$model->is_lk];
                                    },
                                    'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'is_lk',
                                        'data' => [1 => 'Ya', 0 => 'Tidak'],
                                        'options' => [
                                            'placeholder' => 'Pilih...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]),
                            ],
                            [
                                'attribute'=>'is_active',
                                'value' => function ($model){
                                    $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                    return $status[$model->is_active];
                                },
                                'filter' => Select2::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'is_active',
                                    'data' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
                                    'options' => [
                                        'placeholder' => 'Pilih...'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]),
                            ],

                                // ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                                [
                                    'headerOptions'=>['style'=>'min-width:160px'],
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view}{update}{upload}{delete}',
                                    'buttons' => [
                                        'view' => function($url, $model) {
                                            return Html::a('<span class="btn btn-sm btn-default"><b class="fa fa-search-plus"></b></span>', ['view', 'id' => $model['id_anatomi']], ['title' => 'View', 'id' => 'modal-btn-view']);
                                        },
                                        'update' => function($id, $model) {
                                            return Html::a('<span class="btn btn-sm btn-default"><b class="fas fa-pencil-alt"></b></span>', ['update', 'id' => $model['id_anatomi']], ['title' => 'Update', 'id' => 'modal-btn-view']);
                                        },
                                        'upload' => function($url, $model) {
                                            return Html::a('<span class="btn btn-sm btn-warning"><b class="fa fa-upload"></b></span>', ['upload', 'id' => $model['id_anatomi']], ['title' => 'Upload', 'id' => 'modal-btn-view']);
                                        },
                                        'delete' => function ($id, $model) {
                                            return Html::button('<b class="fa fa-trash"></b>', [
                                                'class' => 'btn btn-sm btn-danger',
                                                'data'  => [
                                                    'toggle'    => 'modal',
                                                    'target'    => '#delete-modal',
                                                    'id'        => $model->id_anatomi
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
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>

<!-- tambah Modal -->
<div class="modal fade" id="modalAddAnatomi" tabindex="-1" role="dialog" aria-labelledby="editlabel" data-backdrop="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Form Tambah Anatomi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php 
                // $form = ActiveForm::begin(['id'=>'form-anatomi']); 
                $form = ActiveForm::begin(['id'=>'form-anatomi', 'options' => ['enctype' => 'multipart/form-data']]);

                $anatomiall = $model->AnatomiAll();
            ?> 
            
                <div class="modal-body">
                    <div class="row">   
                        <div class="card-body">
                            <div class="form-group">
                                <?= $form->field($model,'parent_id')->widget(Select2::className(),[
                                    'data' =>  ArrayHelper::map($anatomiall, 'id_anatomi', 'rumpun'),
                                    //'data' =>  ArrayHelper::map($tindakan,'id','deskripsi'),
                                    'options' => [
                                        // 'id'=>'parent_id',
                                        'placeholder' => 'Pilih Anatomi',
                                        'class'=>'form-control-sm'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) 
                                ?>
                               
                            </div>
                            <div class="row">
                                <div class="col">

                                    <?= $form->field($model, 'nama_latin')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col">

                                    <?= $form->field($model, 'nama_indonesia')->textInput(['maxlength' => true ]) ?>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col"><?= $form->field($model, 'is_lk')->checkbox(['value' => 1, ]) ?></div>
                                            <div class="col"><?= $form->field($model, 'is_pr')->checkbox(['value' => 1, ]) ?></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <?= $form->field($model, 'gambar_anatomi')->fileInput(['id'=>'gambar','onchange'=>"tampilkanPreview(this,'preview')", 'class'=>'form-control']) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <b>Preview Gambar</b><br>
                                <img src="<?= $model->gambar_anatomi ?>" id="preview" width="100%"/><br/>
                            </div>
                        </div>
                            
                        </div>
                    </div>  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="simpan" class="btn btn-primary" autocomplete="off">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
           
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
                <button type="submit" id="btnDelete" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    $('#form-anatomi').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var preview =document.getElementById('preview');
        $.ajax({
            url: '<?php echo Url::to(['medis-anatomi/create']) ?>',
            // url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                // console.log('data : ', data);
                swal.fire({
                    title   :'Berhasil Menambahkan Data Anatomi',
                    icon    : "success",
                    timer   : 4000  
                });
                // document.getElementById("form-anatomi").reset();
                $("#form-anatomi").trigger("reset"); 
                preview.src = '';
                $('#modalAddAnatomi').modal('hide');                                 
                $.pjax.reload('#anatomi', {timeout: 3000});

                // handle success response
            },
            error: function(xhr, status, error){
                // handle error response
            }
        });
    });

    function tampilkanPreview(userfile,idpreview)
	{
		var gb = userfile.files;
		for (var i = 0; i < gb.length; i++)
		{
			var gbPreview = gb[i];
			var imageType = /image.*/;
			var preview=document.getElementById(idpreview);
			var reader = new FileReader();
			if (gbPreview.type.match(imageType))
			{
			    //jika tipe data sesuai
                preview.file = gbPreview;
                reader.onload = (function(element){
                    return function(e){
                        element.src = e.target.result;
                    };
                })(preview);
                //membaca data URL gambar
                reader.readAsDataURL(gbPreview);
			}
			else
			{
				//jika tipe data tidak sesuai
				alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
				document.getElementById(userfile.id).value = "";
                preview.style.display = "none"; 
			}
		}
	}

    $('#buttonAdd').click(function(e){
        $('#modalAddAnatomi').modal('show');
    }); 

     $('#delete-modal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id'); 
        $('#id').val(id);        
    });

    $('#btnDelete').click(function(e) {
        e.preventDefault();

        var id  = $('#id').val();

        $.ajax({
            url: '<?php echo Url::to(['medis-anatomi/delete/']) ?>' + '?id=' + id,
            type: 'post', 
            success: function(response) {
                // console.log('response : ', response.success);

                if (response.success === true) {                    
                    swal.fire({
                        title   : response.message,
                        icon    : "success",
                        timer   : 3000  
                    });
                    $('#delete-modal').modal('hide');       
                    $.pjax.reload('#anatomi', {timeout: 3000});

                }else{
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

    

</script>
