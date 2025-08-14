<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\rbac\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
    'nama',
    // [
    //     'attribute' => 'nama',
    //     // 'value' => function ($model) {
    //     //     return $model->pegawai->nama_lengkap;
    //     // },
    // ],
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}'
];
?>
<div class="assignment-index">
     <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Assignments</h5>
                </div>
                <div class="card-body">
                    <?php Pjax::begin(); ?>
                        <div class="table-responsive">
                            <?=
                                GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        $usernameField,
                                        'nama',               
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'contentOptions' => ['style' => 'text-align: center;'],
                                            'header' => 'Aksi',
                                            'template' => '{view}'
                                        ],                          
                                    ],
                                    'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                                    'pager' => [
                                        'class' => 'yii\bootstrap4\LinkPager',
                                    ]
                                ]);
                            ?>
                        </div>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
