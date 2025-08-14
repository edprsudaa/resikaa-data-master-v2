<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Aplikasi */

$this->title = $model->nma;
$this->params['breadcrumbs'][] = ['label' => 'Aplikasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aplikasi-view card card-body">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <hr class="mg-y-30">

    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//                'id',
                'nma',
                'inf:ntext',
                'prm',
                'icn',
                'lnk:ntext',
                'kda',
                'sta:boolean',
//                'crd',
//                'mdd',
            ],
        ]) ?>
    </div>
</div>
