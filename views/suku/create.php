<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Suku */

$this->title = 'Tambah Suku';
$this->params['breadcrumbs'][] = ['label' => 'Suku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="col-md-6">
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