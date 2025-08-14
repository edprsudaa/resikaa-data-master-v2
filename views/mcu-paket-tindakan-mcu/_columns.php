<?php

use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
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
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'kode_paket',
        'hAlign' => 'center',

        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map($paket, 'kode', 'nama'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'format' => 'raw',
        'filterInputOptions' => ['placeholder' => 'Pilih '],
        'value' => 'paket.nama',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kode_tindakan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'kode_unit',
        'hAlign' => 'center',

        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map($unit, 'KD_INST', 'KET'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'format' => 'raw',
        'filterInputOptions' => ['placeholder' => 'Pilih '],
        'value' => 'unit.KET',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'nama_tabel',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'nama_kolom1',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nama_kolom2',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama_tindakan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'harga',
        'value' => function ($model) {
            $v = number_format($model->harga,0,',','.');
            return $v;
        }
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