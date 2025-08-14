<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiMasterBarang */

$this->title = $model->id_barang;
$this->params['breadcrumbs'][] = ['label' => 'Farmasi Master Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id_barang], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id_barang], [
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
                        'id_barang',
                        'is_active:boolean',
                        'created_by',
                        'created_at',
                        'updated_by',
                        'updated_at',
                        'is_deleted:boolean',
                        'deleted_by',
                        'deleted_at',
                        'riwayat:ntext',
                        'kode_barang',
                        'nama_barang',
                        'nama_generik',
                        'id_satuan',
                        'id_kemasan',
                        'tipe_barang',
                        'id_kelompok',
                        'id_jenis',
                        'id_sub_jenis',
                        'id_golongan',
                        'id_klasifikasi',
                        'retriksi:ntext',
                        'deskripsi:ntext',
                        'keterangan:ntext',
                        'isi_per_kemasan',
                        'harga_kemasan',
                        'harga_satuan_terakhir',
                        'harga_satuan_tertinggi',
                        'is_ppn:boolean',
                        'total_ppn',
                        'diskon_persen',
                        'stok_max',
                        'stok_min',
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>