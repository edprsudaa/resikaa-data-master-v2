<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Negara */

$this->title = 'Negara '. $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Negara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                
                    <p>
                        <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
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
                                'label'     => 'Kode Negara',
                                'attribute' => 'kode'
                            ],
                            [
                                'label'     => 'Nama Negara',
                                'attribute' => 'nama'
                            ],
                            [
                                'label'     => 'Status',
                                'attribute' => 'aktif',
                                'value'     => function ($model){
                                $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                return $status[$model->aktif];
                            },
                            ],
                       
                        ],
                    ]) ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>