<?php

use kartik\date\DatePicker;
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
        'attribute'=>'kode_paket',
        'value' => 'tindakan.paket.nama',
        'hAlign' => 'center',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map($paket, 'kode', 'nama'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'format' => 'raw',
        'filterInputOptions' => ['placeholder' => 'Pilih '],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kode_tindakan',
        'value' => 'tindakan.kode_tindakan'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_paket_tindakan_mcu',
        'value' => 'tindakan.nama_tindakan',
        'hAlign' => 'center',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map($paket_tindakan, 'id', 'nama_tindakan'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'format' => 'raw',
        'filterInputOptions' => ['placeholder' => 'Pilih '],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kode_unit',
        'value' => 'tindakan.unit.KET',
        'hAlign' => 'center',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map($unit, 'KD_INST', 'KET'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'format' => 'raw',
        'filterInputOptions' => ['placeholder' => 'Pilih '],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
        'filter'=>DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'tanggal',
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoclose'=>true,
                'size' => '10%',
                'format' => 'yyyy-mm-dd'
                ]
        ])
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'kode_dokter',
        'value' => 'dokter.NAMA',
        'hAlign' => 'center',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map($dokter, 'KODE', 'NAMA'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'format' => 'raw',
        'filterInputOptions' => ['placeholder' => 'Pilih '],
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