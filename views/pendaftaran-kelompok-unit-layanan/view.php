<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranKelompokUnitLayanan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pendaftaran Kelompok Unit Layanan', 'url' => ['index']];
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
                        'unit.nama',
                        [
                            'label'  => 'Type',
                            'value' => function ($model){
                                $status = [1=> 'IGD', 2=> 'RAWAT JALAN REGULER', 3=>'RAWAT INAP', 4=>'PENUNJANG', 5=>'RAWAT JALAN UTAMA'];
                                return $status[$model->type];
                            },
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
    <!--.card-->
</div>