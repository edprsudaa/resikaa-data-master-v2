<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PendaftaranLoketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendaftaran Loket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::a('Create Pendaftaran Loket', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


    <?php Pjax::begin(); ?>
                   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                   <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                           'kode',
                           'nama',
                           'aktif',
                           'is_reg',
                           'is_kasir',
                           //'created_at',
                           //'created_by',
                           //'updated_at',
                           //'updated_by',
                           //'deleted_at',
                           //'deleted_by',

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
