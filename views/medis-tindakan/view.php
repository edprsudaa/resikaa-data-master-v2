<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTindakan */

// $this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Medis Tindakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="d-flex justify-content-center">    
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">Detail Medis Tindakan</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>    
                                <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Apakah kamu Yakin akan Menghapus Data ini?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </p>
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                // 'id',
                                [
                                    'attribute' => 'parent_id',
                                    'value' => $namaParent->deskripsi
                                ],
                                'deskripsi:ntext',
                                [
                                    'label'  => 'Aktif',
                                    'value' => function ($model){
                                        $status = [0=> 'Tidak Aktif', 1=> 'Aktif'];
                                        return $status[$model->aktif];
                                    },
                                ],
                                'kode_jenis',
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
    </div>
</div>