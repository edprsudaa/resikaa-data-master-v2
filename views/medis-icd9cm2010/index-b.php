<?php

use app\components\Helper;
use app\models\MedisIcd9cm2010;
use app\widgets\Alert;
use kartik\select2\Select2;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisIcd9cmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medis Icd9cm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card p-4">
        <div class="row">
            <div class="col-sm-6">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="col-sm-6">
                <p class="float-sm-right">
                    <?= Html::a('<i class="fas fa-plus-circle"></i> Tambah ICD-9', ['create'], [
                        'class' => 'btn btn-success',
                        'data-title' => 'Tambah ICD-9',
                        'data-toggle' => "modal",
                        'data-target' => "#detailModal",
                    ]) ?>
                </p>
            </div>
        </div>

        <?php Pjax::begin(
            [
                'timeout' => false,
                'id' => 'pjax-gridview'
            ]
        ); ?>

        <?php
        if (Yii::$app->request->isAjax)
            echo Alert::widget();
        ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

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
                    'headerOptions' => ['style' => 'min-width:320px'],
                    'attribute' => 'Referensi',
                    'value' => function ($model) {
                        return MedisIcd9cm2010::getOneIcd9Cm2010($model->parent_id);
                    },
                    'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'parent_id',
                        'data' => ArrayHelper::map($icd9cm, 'id', 'rumpun'),
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
                    'attribute' => 'aktif',
                    'value' => function ($model) {
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
                [
                    'headerOptions' => ['style' => 'min-width:160px'],
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $icon = '<span class="btn btn-sm btn-default"><b class="fa fa-search-plus"></b></span>';
                            return Html::a($icon, Url::to(['view', 'id' => $model['id']]), [
                                'data-title' => 'Detail',
                                'data-toggle' => "modal",
                                'data-target' => "#detailModal",
                            ]);
                        },
                        'update' => function ($id, $model) {
                            $icon = '<span class="btn btn-sm btn-default"><b class="fas fa-pencil-alt"></b></span>';
                            return Html::a($icon, Url::to(['update', 'id' => $model['id']]), [
                                'data-title' => 'Update Data',
                                'data-toggle' => "modal",
                                'data-target' => "#detailModal",
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            $icon = '<span class="btn btn-sm btn-danger"><b class="fa fa-trash"></b></span>';
                            // return Html::a('<span class="btn btn-sm btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.', 'method' => 'post', 'data-pjax' => false],]);
                            return Html::a($icon, $url, [
                                // 'title' => Yii::t('app', 'lead-view'),
                                'style' => 'text-decoration: none',
                                'class' => 'btn-alert',
                                'confirm-button-text' => 'Ya, Hapus',
                                'title' => "Hapus Item " . $this->title . " ?",
                                'text' => "Apakah anda yakin ingin menghapus item " . $model->kode . " " . $model->deskripsi . " ?",
                                'cancel-button-text' => 'Batal',
                                'icon' => "warning",
                                'isForDelete' => 'true'
                            ]);
                        },
                        // 'import' => function ($url, $model) {
                        //     return Html::a('<span class="btn btn-sm btn-warning"><b class="fa fa-upload"></b></span>', ['form-import', 'id' => $model['id'], 'kode' => $model['kode']], ['title' => 'Upload', 'id' => 'modal-btn-view']);
                        // }
                    ]
                ],
            ],
            'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
            'pager' => [
                'class' => 'yii\bootstrap4\LinkPager',
            ]
        ]); ?>

        <?php $this->registerJs($this->render('alert.js'), View::POS_END); ?>

        <?php Pjax::end(); ?>
    </div>
    <!--.row-->
</div>

<?php
Modal::begin([
    'id' => 'detailModal',
    'size' => Modal::SIZE_LARGE,
]);

Modal::end();
?>