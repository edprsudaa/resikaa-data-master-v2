<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MedisTarifTindakan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Medis Tarif Tindakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>    
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
                        'id',
                        'tindakan.deskripsi',
                        'kelasrawat.nama',
                        'sktarif.nomor',
                        'js_adm',
                        'js_sarana',
                        'js_bhp',
                        'js_dokter_operator',
                        'js_dokter_lainya',
                        'js_dokter_anastesi',
                        'js_penata_anastesi',
                        'js_paramedis',
                        'js_lainya',
                        'js_adm_cto',
                        'js_sarana_cto',
                        'js_bhp_cto',
                        'js_dokter_operator_cto',
                        'js_dokter_lainya_cto',
                        'js_dokter_anastesi_cto',
                        'js_penata_anastesi_cto',
                        'js_paramedis_cto',
                        'js_lainya_cto',
                        'created_at',
                        'created_by',
                        'updated_at',
                        'updated_by',
                        'is_deleted',
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