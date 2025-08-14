<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\PegawaiUnitPenempatan;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MappingPoliBpjsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mapping Poli Bpjs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-poli-bpjs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mapping Poli Bpjs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bpjs_kode',
            'bpjs_nama',
            'bpjs_sub_kode',
            'bpjs_sub_nama',
            [
                'attribute'=>'simrs_kode',
                'value' => function ($model) {
                    $unitPenempatan = PegawaiUnitPenempatan::findOne(['kode' => $model->simrs_kode]);

                    if ($unitPenempatan !== null) {
                        return $unitPenempatan->nama . ' ('.$unitPenempatan->kode.')';
                    } else {
                        return '-';
                    }
                },
                
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
