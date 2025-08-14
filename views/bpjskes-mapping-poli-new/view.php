<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BpjskesMappingPoliNew */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bpjskes Mapping Poli News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bpjskes-mapping-poli-new-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'bpjs_kode',
            'bpjs_nama',
            'bpjs_sub_kode',
            'bpjs_sub_nama',
            'simrs_kode',
        ],
    ]) ?>

</div>
