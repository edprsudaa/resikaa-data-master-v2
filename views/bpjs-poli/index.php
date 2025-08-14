<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BpjsPoliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'BPJS Poli';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::a('Create BPJS Poli', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


    <?php Pjax::begin(); ?>
                   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                   <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                           'id',
                           'poli_bpjs_id',
                           'poli_bpjs_nama',
                        //    'created_at',
                        //    'updated_at',

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],
                        'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>

    <?php Pjax::end(); ?>

                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
