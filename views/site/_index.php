<?php
use yii\grid\GridView;
?>
<?=
 GridView::widget([
  'dataProvider' => $dataProvider,
  'columns' => [
   [
    'class' => 'yii\grid\SerialColumn'
   ],
   'id_nip_nrp',
   'nama_lengkap'
  ]
 ])
?>