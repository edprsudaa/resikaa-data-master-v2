<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranKirimanDetail */

$this->title = 'Create Pendaftaran Kiriman Detail';
$this->params['breadcrumbs'][] = ['label' => 'Pendaftaran Kiriman Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'kiriman' => $kiriman
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>