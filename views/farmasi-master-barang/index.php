<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FarmasiMasterBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Farmasi Master Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::a('Create Farmasi Master Barang', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                   <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                        //    'id_barang',
                        //    'is_active:boolean',
                        //    'created_by',
                        //    'created_at',
                        //    'updated_by',
                           //'updated_at',
                           //'is_deleted:boolean',
                           //'deleted_by',
                           //'deleted_at',
                           //'riwayat:ntext',
                           'kode_barang',
                           'nama_barang',
                           'nama_generik',
                           'id_satuan',
                           'id_kemasan',
                           'tipe_barang',
                           //'id_kelompok',
                           //'id_jenis',
                           //'id_sub_jenis',
                           //'id_golongan',
                           //'id_klasifikasi',
                           //'retriksi:ntext',
                           //'deskripsi:ntext',
                           //'keterangan:ntext',
                           //'isi_per_kemasan',
                           //'harga_kemasan',
                           //'harga_satuan_terakhir',
                           //'harga_satuan_tertinggi',
                           //'is_ppn:boolean',
                           //'total_ppn',
                           //'diskon_persen',
                           //'stok_max',
                           //'stok_min',

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],
                        'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>


                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
