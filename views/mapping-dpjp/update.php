<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MappingDpjp */

$this->title = 'Update Mapping Dpjp: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mapping Dpjps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mapping-dpjp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pegawai' => $pegawai,
        'mappingPoliBpjs' => $mappingPoliBpjs
    ]) ?>

</div>
