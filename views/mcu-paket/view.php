<?php

use app\components\Helper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\McuPaket */
?>
<div class="mcu-paket-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode',
            'nama',
            'is_active',
            'kode_debitur',
			[
                'label'  => 'Jenis Paket',
                'value' => function ($model) {
					$JenisPaket = [1 => 'Umum', 2 => 'Instansi', 3 => 'Umum Instansi'];
                    return $JenisPaket[$model->jenis_paket];
                },
            ],
        ],
    ]) ?>

    <table class="table table-bordered">
        <thead>                  
        <tr>
            <th style="width: 10px">#</th>
            <th>Kode Tindakan</th>
            <th>Unit</th>
            <th>Nama Tindakan</th>
            <th>Harga</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;
        $tot_harga=0;
        foreach ($paket_tindakan as $pkt_tdkn) { 
            $tot_harga += $pkt_tdkn['harga'];
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $pkt_tdkn['kode_tindakan'] ?></td>
            <td><?= Helper::getUnit($pkt_tdkn['kode_unit']) ?></td>
            <td><?= $pkt_tdkn['nama_tindakan'] ?></td>
            <td><?= number_format($pkt_tdkn['harga'],0,',','.') ?></td>
        </tr>
        <?php $no++; } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><b>Total Harga</b></td>
                <td><b><?= number_format($tot_harga,0,',','.') ?></b></td>
            </tr>
        </tfoot>
    </table>
    

</div>
