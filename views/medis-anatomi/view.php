<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MedisAnatomi */

$this->title = $model->id_anatomi;
$this->params['breadcrumbs'][] = ['label' => 'Medis Anatomi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <p>
                        <?= Html::a('<i class="fa fa-backward"></i> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>    
                        <?= Html::a('Update', ['update', 'id' => $model->id_anatomi], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Upload', ['upload', 'id' => $model->id_anatomi], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id_anatomi], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                        'id_anatomi',
                        'parent_id',
                        // 'created_by',
                        // 'created_at',
                        // 'updated_by',
                        // 'updated_at',
                        // 'is_deleted',
                        // 'deleted_by',
                        // 'deleted_at',
                        'nama_latin',
                        'nama_indonesia',
                        // 'gambar_anatomi',
                        [
                            'attribute'=>'is_lk',
                            'value' => function ($model){
                                $jenkel = [0 => 'Tidak', 1 => 'Ya'];
                                return $jenkel[$model->is_lk];
                            },
                        ],
                        [
                            'attribute'=>'is_pr',
                            'value' => function ($model){
                                $jenkel = [0 => 'Tidak', 1 => 'Ya'];
                                return $jenkel[$model->is_pr];
                            },
                        ],
                        [
                            'attribute'=>'is_active',
                            'value' => function ($model){
                                $jenkel = [0 => 'Tidak', 1 => 'Ya'];
                                return $jenkel[$model->is_active];
                            },
                        ],
                        ],
                    ]) ?>
                    </div>

                    <div class="col-md-3">
                        <br/>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td align="center"><img src="<?= $model->gambar_anatomi ?>" width="200" height="500"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>