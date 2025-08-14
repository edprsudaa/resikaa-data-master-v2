<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MedisIcd10cm */

$this->title = 'Create Medis Icd10cm';
$this->params['breadcrumbs'][] = ['label' => 'Medis Icd10cms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'icd10cm' => $icd10cm,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>