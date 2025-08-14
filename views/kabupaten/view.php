<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kabupaten */

$this->title = $model->jenis . ' '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kabupaten', 'url' => ['index']];
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
                            <?= Html::a('Ubah', ['update', 'id' => $model->kode_prov_kabupaten], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Hapus', ['delete', 'id' => $model->kode_prov_kabupaten], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Apakah Anda Yakin ingin Menghapus Data Ini?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute' => 'kode_prov',
                                    'label'     => "Provinsi",
                                    'value'     => function ($model){
                                        return $model->provinsi->nama;
                                    }
                                ],
                                [
                                    'attribute' => 'kode_prov_kabupaten',
                                    'label'     => 'Kode Kabupaten/Kota'
                                ],
                                [
                                    'attribute' => 'nama',
                                    'label'     => 'Nama Kabupaten/Kota'
                                ],
                                [
                                    'attribute' => 'jenis',
                                    'label'     => 'Jenis Daerah Kabupaten/Kota'
                                ],
                               
                                [
                                    'attribute' => 'aktif',
                                    'label'     => 'Status Kabupaten/Kota',
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