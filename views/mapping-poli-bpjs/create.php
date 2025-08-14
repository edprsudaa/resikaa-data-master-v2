<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MappingPoliBpjs */

$this->title = 'Create Mapping Poli Bpjs';
$this->params['breadcrumbs'][] = ['label' => 'Mapping Poli Bpjs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-poli-bpjs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
