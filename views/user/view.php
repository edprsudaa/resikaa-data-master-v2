<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AkunAknUser */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Akun Identitas Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->userid], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->userid], [
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
//                'userid',
                'id_pegawai',
                'username',
//                'password',
                'nama',
                /*[
                    'attribute' => 'tanggal_pendaftaran',
                    'value' => function ($model) {
                        Yii::$app->formatter->asDatetime($model->tanggal_pendaftaran);
                    }
                ],*/

                'tanggal_pendaftaran:datetime',
                'role',
//                'token_aktivasi:ntext',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        if ($model->status == '0') {
                            return 'Pending';
                        } elseif ($model->status == '1') {
                            return 'Aktif';
                        } else {
                            return 'Tidak Aktif';
                        }
                    }
                ]
            ],
        ]) ?>
    </div>
</div>
