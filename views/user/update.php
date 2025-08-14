<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AkunAknUser */

$this->title = 'Update Akun Akn Identitas: ' . $model->userid;
$this->params['breadcrumbs'][] = ['label' => 'Akun Akn Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userid, 'url' => ['view', 'id' => $model->userid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akun-akn-user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
