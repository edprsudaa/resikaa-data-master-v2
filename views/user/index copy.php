<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AkunAknUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Akun Identitas';
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
                                // 'status',

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Aksi',
                                    'template' => '{view}{update}{delete}',
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
                                                    // 'nama'    => $model->nma,
                                                    // 'deskripsi'  => $model->inf,  
                                                    // 'permission'  => $model->prm,  
                                                    // 'icon'  => $model->icn,  
                                                    // 'link'  => $model->lnk,  
                                                    // 'kode_akses'  => $model->kda,  
                                                    // 'status'    => $model->sta ? 'true' : 'false',
                                                ],
                                            ]);
                                        },

                                    
                                        'delete' => function ($url, $model) {
                                            return Html::button('<b class="fa fa-trash"></b>', [
                                                'class' => 'btn btn-sm btn-danger',
                                                'data'  => [
                                                    'toggle'    => 'modal',
                                                    'target'    => '#delete-modal',
                                                    'id'        => $model->userid
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
                                            return Html::a('<span class="fa fa-spinner"></span>', $url, [
                                                'title' => Yii::t('app', 'Reset Password'),
                                                'class' => 'btn btn-info'
                                            ]);
                                        },


                                    ],
                                    'urlCreator' => function ($action, $model, $key, $index) {
                                        if ($action === 'reset') {
                                            $url = \yii\helpers\Url::to(['/user/reset-password', 'id' => $model->userid, 'y' => $model->username]);
                                            return $url;
                                        }
                                    }
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
                      
                    </thead>
                </table>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

                if(response.data.status = 0){
                    $('#status-detail').html('PENDING');
                }else if(response.data.status = 1){
                    $('#status-detail').html('AKTIF');
                }else{
                    $('#status-detail').html('TIDAK AKTIF');
                }
            }
        });
    });
</script>

<!-- 

<div class="akun-akn-user-index box box-primary">
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Reset Password Berhasil Dilakukan Oleh <i><?= Yii::$app->user->identity->getNama() ?></i>
    </div>
    <?php endif; ?>
    <?php Pjax::begin(); ?>
    <h1 class="df-title">Form Tambah User</h1>
    <hr class="mg-y-30">
    <div class="card card-body">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//                ['class' => 'yii\grid\ActionColumn'],

//                'userid',
//                'id_pegawai',
                'username',
//                'password',
                'nama',
//                 'tanggal_pendaftaran',
                'role',
                // 'token_aktivasi:ntext',
                // 'status',

                [
                    'class' => 'app\components\ActionColumn',
                    'header' => 'Actions',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Reset Password',
                    'headerOptions' => ['style' => 'color:#337ab7;text-align: center;min-width: 10px;'],
                    'options' => ['style' => 'width:70px;text-align: center'],
                    'template' => '{reset}',
                    'buttons' => [
                        'reset' => function ($url, $model) {
                            return Html::a('<span class="fa fa-spinner"></span>', $url, [
                                'title' => Yii::t('app', 'Reset Password'),
                                'class' => 'btn btn-info'
                            ]);
                        },


                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'reset') {
                            $url = \yii\helpers\Url::to(['/user/reset-password', 'id' => $model->userid, 'y' => $model->username]);
                            return $url;
                        }
                    }
                ],
            ],
            'pager' => [
                'class' => 'app\components\GridPager',
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div> -->
