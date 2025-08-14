<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MasterDataDasarRsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Master Rumah Sakit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-rumah-sakit-index">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">

                                <div class="col-sm-6">
                                    <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
                                </div>
                                <div class="col-sm-6">
                                    <p class="float-sm-right">

                                     <?= Html::a('+ Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
                                       
                                       
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                          
                            <?php Pjax::begin(); ?>
                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    // 'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        // 'id',
                                        [
                                            'label' => 'Kode Rumah Sakit',
                                            'attribute' => 'nomor_kode_rs',
                                            // 'headerOptions'=> ['style'=>'width:200px','class'=>'text-center'],
                                            // 'contentOptions' => ['class'=>'text-center'],
                                            // 'value'  => function($model){
                                            //     return $model->nama_lengkap;
                                            // }
                                        ],
                                        // 'no_kode_rs',
                                        [
                                            'label' => 'Nama Rumah Sakit',
                                            'attribute' => 'nama_rs',
                                                // 'value' => $model->nama_rs
                                        ],
                                        [
                                            'label' => 'Akreditasi Rumah Sakit',
                                            'attribute' => 'akreditasi_rs',
                                            
                                        ],
                                        [
                                            'label' => 'Jenis Rumah Sakit',
                                            'attribute' => 'jenis_rs',
                                        ],
                                        [
                                            'label' => 'Kelas Rumah Sakit',
                                            'attribute' => 'kelas_rs',
                                        ],
                                        [
                                            'label' => 'Nama Direktur Rumah Sakit',
                                            'attribute' => 'nama_direktur_rs',
                                        ],
                                        
                                        [
                                            
                                            'class' => 'yii\grid\ActionColumn', 
                                            'headerOptions' => ['style'=>'width:140px'],
                                            'template' => '{view} {update} {delete}',
                                            'buttons'       => [
                                                'view'  => function($url,$model){
                                                    $icon = '<span class="btn btn-sm btn-info"><b class="fas fa-eye"></b></span>';
                                                    $url = Yii::$app->urlManager->createUrl(['master-data-dasar-rs/view','id'=>$model->id]);
                                                    return Html::a($icon, $url, ['title'=>'Detail']);
                                                },
                                                'update'  => function($url,$model){
                                                    $icon = '<span class="btn btn-sm btn-warning"><b class="fas fa-pen"></b></span>';
                                                    $url = Yii::$app->urlManager->createUrl(['master-data-dasar-rs/update','id'=>$model->id]);
                                                    return Html::a($icon, $url, ['title'=>'Update']);
                                                },
                                            
                                                'delete'  => function($url,$model){
                                                    $url = Yii::$app->urlManager->createUrl(['master-data-dasar-rs/delete','id'=>$model->id]);
                                                    $icon = '<span class="btn btn-sm btn-danger"><b class="fas fa-trash"></b></span>';
                                                    return Html::a($icon, $url, [
                                                        'title'=>'Delete',
                                                        'data-confirm' => Yii::t('yii', 'Apakah Yakin ingin menghapus Data ini?'),
                                                        'data-method' => 'post',
                                                    ]);
                                                },
                                            ],  
                                                
                                        ],
                                    ],
                                ]); ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

