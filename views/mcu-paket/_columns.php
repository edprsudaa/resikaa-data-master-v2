<?php
use yii\helpers\Url;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'kode',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'is_active',
        'value' => function ($model){
            $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
            return $status[$model->is_active];
        },
        'filter' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kode_debitur',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'jenis_paket',
        'value' => function ($model) {
            $JenisPaket = [1 => 'Umum', 2 => 'Instansi', 3 => 'Umum Instansi'];
            return $JenisPaket[$model->jenis_paket];
        },
        'filter' => [1 => 'Umum', 2 => 'Instansi', 3 => 'Umum Instansi'],
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'],
        // 'visibleButtons'=>[
        // 'delete'=>false,
        // ], 
    ],

];  