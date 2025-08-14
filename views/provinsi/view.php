<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Provinsi */

$this->title = 'Provinsi '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                            <?= Html::a('Ubah', ['update', 'id' => $model->kode], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Hapus', ['delete', 'id' => $model->kode], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute' => 'kode',
                                    'label'     => 'Kode Provinsi'
                                ],
                                [
                                    'attribute' => 'nama',
                                    'label'     => 'Nama Provinsi'
                                ],
                                [
                                    'attribute' => 'aktif',
                                    'label'     => 'Status Provinsi',
                                    'value'     => function ($model){
                                        $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                        return $status[$model->aktif];
                                    }
                                ],
                            
                            // 'created_at',
                            // 'created_by',
                            // 'updated_at',
                            // 'updated_by',
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