<?php

use app\components\Helper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisIcd10cmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medis Icd10cm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::a('Create Medis Icd10cm', ['create'], ['class' => 'btn btn-success']) ?>
                            <!-- <?= Html::a('Download Format File Import', ['download'], ['class' => 'btn btn-primary']) ?> -->
                        </div>
                    </div>


                   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                   <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                           //'id',
                           //'parent_id',
                           'kode',
                           'deskripsi:ntext',
                           [
                            'headerOptions'=>['style'=>'min-width:320px'],    
                            'attribute' => 'Referensi',
                                'value' => function ($model){
                                    return Helper::getIcd10Cm($model->parent_id);
                                },
                                'filter' => Select2::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'parent_id',
                                    'data' => ArrayHelper::map($icd10cm, 'id', 'rumpun'),
                                    'options' => [
                                        'placeholder' => 'Pilih...'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]),
                           ],
                           //'keterangan:ntext',
                           [
                            'attribute'=>'aktif',
                            'value' => function ($model){
                                $status = [0 => 'Tidak Aktif', 1 => 'Aktif'];
                                return $status[$model->aktif];
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'aktif',
                                'data' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
                                'options' => [
                                    'placeholder' => 'Pilih...'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
                           ],
                           //'created_at',
                           //'created_by',
                           //'updated_at',
                           //'updated_by',
                           //'is_deleted',

                           [
                            'headerOptions'=>['style'=>'min-width:160px'],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}{update}{delete}{import}',
                            'buttons' => [
                                'view' => function($url, $model) {
                                    return Html::a('<span class="btn btn-sm btn-default"><b class="fa fa-search-plus"></b></span>', ['view', 'id' => $model['id']], ['title' => 'View', 'id' => 'modal-btn-view']);
                                },
                                'update' => function($id, $model) {
                                    return Html::a('<span class="btn btn-sm btn-default"><b class="fas fa-pencil-alt"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Update', 'id' => 'modal-btn-view']);
                                },
                                'delete' => function($url, $model) {
                                    return Html::a('<span class="btn btn-sm btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.', 'method' => 'post', 'data-pjax' => false],]);
                                },
                                'import' => function($url, $model) {
                                    return Html::a('<span class="btn btn-sm btn-warning"><b class="fa fa-upload"></b></span>', ['form-import', 'id' => $model['id'], 'kode' => $model['kode']], ['title' => 'Upload', 'id' => 'modal-btn-view']);
                                }
                                ]
                            ],
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
