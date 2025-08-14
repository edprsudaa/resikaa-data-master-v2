<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MappingDpjp */

$this->title = 'Create Mapping Dpjp';
$this->params['breadcrumbs'][] = ['label' => 'Mapping Dpjps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-dpjp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pegawai' => $pegawai,
        'mappingPoliBpjs' => $mappingPoliBpjs
    ]) ?>

</div>
