<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

//UPDATE pegawai.tb_pegawai
//SET pegawai_id=13, nama_lengkap='FRANSISKUS HAMIDO HUTAURUK', gelar_sarjana_depan='dr', gelar_sarjana_belakang=' Sp.OG', tempat_lahir=NULL, tanggal_lahir='1957-10-10', jenis_kelamin='Laki-Laki', status_perkawinan='Kawin', agama='1', alamat_tempat_tinggal='Jl. Angsa I No. 8', rt_tempat_tinggal='4', rw_tempat_tinggal='3', desa_kelurahan=NULL, kecamatan='1471060', kabupaten_kota='1471', provinsi='14', kode_pos=NULL, no_telepon_1='0812-7517907', no_telepon_2=NULL, golongan_darah=NULL, status_kepegawaian_id=121, jenis_kepegawaian_id=4, nomor_karpeg='E. 334430', nomor_kartu_askes='21481481', nomor_kartu_taspen='140187957', nomor_karis_karsu='Proses', npwp='07.247.568.4-216.000', nomor_ktp='1471011010670000', nota_persetujuan_bkn_nomor_cpns='II-2200027898', nota_persetujuan_bkn_tanggal_cpns='1988-06-09', pejabat_yang_menetapkan_cpns='MENTERI KESEHATAN', sk_cpns_nomor_cpns='35313/B.Pers/401/PB 1/86', sk_cpns_tanggal_cpns='1987-02-10', kode_pangkat_cpns=132, tmt_cpns='1986-01-10', masa_kerja_tahun_cpns=NULL, masa_kerja_bulan_cpns=NULL, pejabat_yang_menetapkan_pns='MENTERI KESEHATAN', sk_nomor_pns='31200/Pers/1605/PNS/1987', sk_tanggal_pns='1988-10-12', kode_pangkat_pns='131', tmt_pns='1988-01-10', sumpah_janji_pns='Sudah', masa_kerja_tahun_pns='1', masa_kerja_bulan_pns='3', tinggi_keterangan_badan=163, berat_badan_keterangan_badan=85, rambut_keterangan_badan='Hitam', bentuk_muka_keterangan_badan='Lonjong', warna_kulit_keterangan_badan='Sawo Matang', ciri_ciri_khas_keterangan_badan='Tidak Ada', cacat_tubuh_keterangan_badan='Tidak Ada', kegemaran_1='Olahraga', kegemaran_2='Musik', kegemaran_3=NULL, photo=NULL, status_aktif_pegawai=1, kode_kategori_pegawai='216', kode_jenis_kepegawaian_rl4='102', masa_kerja_honorer=0, tipe_user=1
//WHERE id_nip_nrp='195710101986101001';

$this->title = 'Koreksi Data User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
	<div class="row">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th>Id Pegawai (SSO)</th>
				<th>Id Pegawai (SIP)</th>
				<th>Nama</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($user as $item): ?>
				<tr>
					<td><?= $item->id_pegawai ?></td>
					<td><?php
						$tb = \app\models\TbPegawai::find()->where(['id_nip_nrp' => $item->username])->one();

						echo $tb->pegawai_id;

						if ($item->id_pegawai != $tb->pegawai_id) {
							Yii::$app->db->createCommand("UPDATE sso.akn_user SET id_pegawai='$tb->pegawai_id' WHERE username='{$item->username}'")->execute();
						}
						?></td>
					<td><?= $item->nama ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
