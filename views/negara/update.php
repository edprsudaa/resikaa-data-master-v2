<?php

/* @var $this yii\web\View */
/* @var $model app\models\Negara */

$this->title = 'Ubah Negara ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Negara', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?=$this->render('_form', [
                            'model' => $model
                        ]) ?>
                    </div>
                </div>
            </div>
            <!--.card-body-->
        </div>
    </div>
    <!--.card-->
</div>