<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BpjskesMappingPoliNew */

$this->title = 'Create Bpjskes Mapping Poli New';
$this->params['breadcrumbs'][] = ['label' => 'Bpjskes Mapping Poli News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bpjskes-mapping-poli-new-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
