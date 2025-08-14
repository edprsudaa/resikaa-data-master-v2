<?php

use app\components\Helper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedisTarifTindakanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medis Tarif Tindakan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::a('Create Medis Tarif Tindakan', ['create'], ['class' => 'btn btn-success']) ?>
                            <?= Html::button('Download Format File Import', [ 'class' => 'btn btn-primary', 'onclick' => 'ImportTindakan()' ]); ?>
                            <?= Html::a('Import Tarif Tindakan', ['form-import'], ['class' => 'btn btn-warning', 'title' => 'Upload']); ?>
                        </div>
                    </div>


                    <?php // echo $this->render('_search', ['model' => $searchModel]); 
                    ?>

                    <div class="card-body  p-0">
                        <div class="table-responsive">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    'id',
                                    [
                                        'attribute' => 'sk_tarif_id',
                                        'value' => 'sktarif.nomor',
                                        'headerOptions'=>['style'=>'min-width:220px'],
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'sk_tarif_id',
                                            'data' => ArrayHelper::map($sk_tarif, 'id', 'nomor'),
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute' => 'kelas_rawat_kode',
                                        'value' => 'kelasrawat.nama',
                                        'headerOptions'=>['style'=>'min-width:220px'],
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'kelas_rawat_kode',
                                            'data' => ArrayHelper::map($kelas_rawat, 'kode', 'nama'),
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'attribute' => 'tindakan_id',
                                        'value' => 'tindakan.deskripsi',
                                        'headerOptions'=>['style'=>'min-width:220px'],
                                        'filter' => Select2::widget([
                                            'model' => $searchModel,
                                            'attribute' => 'tindakan_id',
                                            'data' => ArrayHelper::map($tindakan, 'id', 'deskripsi'),
                                            'options' => [
                                                'placeholder' => 'Pilih...'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]),
                                    ],
                                    [
                                        'headerOptions'=>['style'=>'min-width:320px'],    
                                        'attribute' => 'Referensi',
                                            'value' => function ($model){
                                                return Helper::getTindakan($model->tindakan_id);
                                            },
                                            'filter' => Select2::widget([
                                                'model' => $searchModel,
                                                'attribute' => 'Referensi',
                                                'data' => ArrayHelper::map($referensi, 'id', 'rumpun'),
                                                'options' => [
                                                    'placeholder' => 'Pilih...'
                                                ],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]),
                                       ],
                                    [
                                        'attribute'=>'js_adm',
                                        'value' => function ($model){
                                            return $model->js_adm;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_sarana',
                                        'value' => function ($model){
                                            return $model->js_sarana;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_bhp',
                                        'value' => function ($model){
                                            return $model->js_bhp;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_dokter_operator',
                                        'value' => function ($model){
                                            return $model->js_dokter_operator;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_dokter_lainya',
                                        'value' => function ($model){
                                            return $model->js_dokter_lainya;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_dokter_anastesi',
                                        'value' => function ($model){
                                            return $model->js_dokter_anastesi;
                                        },
                                        'format'=> 'decimal',
                                        
                                    ],
                                    [
                                        'attribute'=>'js_penata_anastesi',
                                        'value' => function ($model){
                                            return $model->js_penata_anastesi;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_paramedis',
                                        'value' => function ($model){
                                            return $model->js_paramedis;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_lainya',
                                        'value' => function ($model){
                                            return $model->js_lainya;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_adm_cto',
                                        'value' => function ($model){
                                            return $model->js_adm_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_sarana_cto',
                                        'value' => function ($model){
                                            return $model->js_sarana_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_bhp_cto',
                                        'value' => function ($model){
                                            return $model->js_bhp_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_dokter_operator_cto',
                                        'value' => function ($model){
                                            return $model->js_dokter_operator_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_dokter_lainya_cto',
                                        'value' => function ($model){
                                            return $model->js_dokter_lainya_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_dokter_anastesi_cto',
                                        'value' => function ($model){
                                            return $model->js_dokter_anastesi_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_penata_anastesi_cto',
                                        'value' => function ($model){
                                            return $model->js_penata_anastesi_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_paramedis_cto',
                                        'value' => function ($model){
                                            return $model->js_paramedis_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                                    [
                                        'attribute'=>'js_lainya_cto',
                                        'value' => function ($model){
                                            return $model->js_lainya_cto;
                                        },
                                        'format'=> 'decimal',
                                    ],
                          
                                    //    'created_at',
                                    //    'created_by',
                                    //    'updated_at',
                                    //    'updated_by',
                                    //    'is_deleted',

                                    [
                                        'headerOptions'=>['style'=>'min-width:135px'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}{update}{delete}',
                                        'buttons' => [
                                            'view' => function ($url, $model) {
                                                return Html::a('<span class="btn btn-sm btn-default"><b class="fa fa-search-plus"></b></span>', ['view', 'id' => $model['id']], ['title' => 'View', 'id' => 'modal-btn-view']);
                                            },
                                            'update' => function ($id, $model) {
                                                return Html::a('<span class="btn btn-sm btn-default"><b class="fas fa-pencil-alt"></b></span>', ['update', 'id' => $model['id']], ['title' => 'Update', 'id' => 'modal-btn-view']);
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<span class="btn btn-sm btn-danger"><b class="fa fa-trash"></b></span>', ['delete', 'id' => $model['id']], ['title' => 'Delete', 'class' => '', 'data' => ['confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.', 'method' => 'post', 'data-pjax' => false],]);
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
                    </div>
                    <!--.card-body-->
                </div>
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>

<div class="modal fade" id="mymodal" tabindex="false" data-keyboard='false' role="dialog" aria-labelledby="myModalLabel"></div>

<script>
    function ImportTindakan() {

      $.ajax({
        url: '<?= Yii::$app->urlManager->createUrl('medis-tarif-tindakan/form-export') ?>',

        // dataType: 'json',
        type: 'POST',
        success: function(output) {

          $('#mymodal').html(output);
          $('#mymodal').modal({
            backdrop: 'static',
            keyboard: false
          });

        }
      });

  }
</script>