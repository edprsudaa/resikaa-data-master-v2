<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BpjskesMappingPoliNew */

$this->title = 'Update Bpjskes Mapping Poli New: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bpjskes Mapping Poli News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bpjskes-mapping-poli-new-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
