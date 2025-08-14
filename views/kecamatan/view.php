<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kecamatan */

$this->title = 'Kecamatan ' .$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kecamatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="col-md-6">
            <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                        <!-- <?= Html::a('Ubah', ['update', 'id' => $model->kode_prov_kab_kecamatan], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Hapus', ['delete', 'id' => $model->kode_prov_kab_kecamatan], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?> -->
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'kode_prov_kab_kecamatan',
                                'label'     => 'Kode Kecamatan'
                            ],
                            [
                                'attribute' => 'nama',
                                'label'     => 'Nama Kecamatan'
                            ],
                            [
                                'attribute' => 'kode_prov_kab',
                                'label'     => 'Kabupaten',
                                'value'     => function ($model){                                
                                    return $model->kabupaten->nama;
                                }
                            ],
                            [
                                'attribute' => 'kode_prov',
                                'label'     => 'Provinsi',
                                'value'     => function ($model){                                
                                    return $model->kabupaten->provinsi->nama;
                                }
                            ],                           
                            [
                                'attribute' => 'aktif',
                                'label'     => 'Status Kecamatan',
                                'value'     => function ($model){
                                    $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];                                    
                                    return $status[$model->aktif];
                                }
                            ],
                            [
                                'attribute' => 'created_at',
                                'label'     => 'Dibuat',
                                'value'     => function ($model){
                                    $created_at =date('d-M-Y H:i:s', strtotime($model->created_at));                                    
                                    $created_by = $model->created_by;                                    
                                    return $model->created_at == null ? '-' : $created_at .' ('.$created_by.')';
                                }
                            ],
                            [
                                'attribute' => 'updated_at',
                                'label'     => 'Diubah',
                                'value'     => function ($model){
                                    $updated_at =date('d-M-Y H:i:s', strtotime($model->updated_at));                                    
                                    $updated_by = $model->updated_by;   
                                                                     
                                    return $model->updated_at == null ? '-' : $updated_at .' ('.$updated_by.')';
                                }
                            ],
                         
                            // 'is_deleted',
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    </div>
    
    <!--.card-->
</div>