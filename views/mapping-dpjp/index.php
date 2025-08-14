<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\TbPegawai;
use kartik\select2\Select2;
use app\components\HelperSpesial;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MappingDpjpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mapping Dpjps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-dpjp-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mapping Dpjp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bpjs_dpjp_kode',
            [
                'attribute'=>'simrs_dpjp_kode',
                'label' => 'DPJP',
                'value' => function ($model) {
                    $pegawai = TbPegawai::findOne(['pegawai_id' => $model->simrs_dpjp_kode]);

                    
                    if (!empty($pegawai->gelar_sarjana_depan) && !empty($pegawai->gelar_sarjana_belakang)) {
                        $nama_pegawai = $pegawai->gelar_sarjana_depan . ". " . $pegawai->nama_lengkap . ", " . $pegawai->gelar_sarjana_belakang;
                    } else if (!empty($pegawai->gelar_sarjana_depan) && empty($pegawai->gelar_sarjana_belakang)) {
                        $nama_pegawai = $pegawai->gelar_sarjana_depan . ". " . $pegawai->nama_lengkap;
                    } else if (empty($pegawai->gelar_sarjana_depan) && !empty($pegawai->gelar_sarjana_belakang)) {
                        $nama_pegawai = $pegawai->nama_lengkap . ", " . $pegawai->gelar_sarjana_belakang;
                    } else if (empty($pegawai->gelar_sarjana_depan) && empty($pegawai->gelar_sarjana_belakang)) {
                        $nama_pegawai = $pegawai->nama_lengkap ?? '-';
                    }


                    if ($pegawai !== null) {
                        return $nama_pegawai . ' ('.$pegawai->pegawai_id.')';
                    } else {
                        return 'Nama Pegawai Tidak Ditemukan';
                    }
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'simrs_dpjp_kode',
                    'data' => HelperSpesial::getListDokter(false,true),
                    'options' => [
                        'placeholder' => 'Pilih Dokter...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                
            ],
            [
                'attribute' => 'poli_kode_bpjs'
            ],
            [
                'attribute' => 'sub_poli_kode_bpjs',
                'value' => function ($model) {
                    $namaSubPoliBpjs = $model->mappingPoliBpjs->bpjs_sub_nama ?? '-';
                    $kodeSubPoliBpjs = $model->sub_poli_kode_bpjs ?? '-';
                    return '(' . $kodeSubPoliBpjs . ') ' . $namaSubPoliBpjs;
                },
                'filter' => \kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'sub_poli_kode_bpjs',
                    'data' => $subPoliOptions,
                    'options' => ['placeholder' => 'Semua Sub Poli'],
                    'pluginOptions' => ['allowClear' => true],
                ]),
                'filterInputOptions' => ['class' => 'form-control'],
            ],

            [
                'attribute' => 'kategori_medis',
                'value' => function ($model) {
                    switch ($model->kategori_medis) {
                        case 1:
                            return 'Dokter Umum / Dokter Gigi';
                        case 2:
                            return 'Dokter Spesialis / Dokter Gigi Spesialis';
                        case 3:
                            return 'Dokter Sub Spesialis';
                        case 4:
                            return 'Dokter Konsultan';
                        default:
                            return '-';
                    }
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'kategori_medis',
                    'data' =>  [
                        1 => 'Dokter Umum / Dokter Gigi',
                        2 => 'Dokter Spesialis / Dokter Gigi Spesialis',
                        3 => 'Dokter Sub Spesialis',
                        4 => 'Dokter Konsultan',
                    ],
                    'options' => [
                        'placeholder' => 'Pilih Kategori'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            'simrs_dpjp_kode_old',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
