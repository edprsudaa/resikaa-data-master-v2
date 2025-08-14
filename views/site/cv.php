<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Riwayat Hidup</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
			width: 100%;
        }

        table tr th td {
            font-size: 12px;
        }

		th, td {
		padding: 5px;
		text-align: left;
		}

        .table-with-border {
            border-collapse: collapse;
            padding: 10px 5px;
        }

        .table-with-border-header {
            border: 2px solid black;
        }

        .table-with-border-body {
            border-top: none;
            border-bottom: none;
            border-right: 2px solid black;
            border-left: 2px solid black;
        }

        .table-with-border-footer {
            border: 2px solid black;
        }

        .font-label {
            max-width: 10%;
            vertical-align: text-top;
        }

        .font-isi {
            max-width: 38%;
            vertical-align: text-top;
        }

        .font-colon {
            max-width: 2%;
            text-align: left;
            vertical-align: text-top;
        }

        .table-header {
            padding: 0px;
            min-height: 100px;
            border: none;
            line-height: 1;
            margin-top: -10px;
        }

        .table-header td {
            word-wrap: break-word;
            vertical-align: text-top;
        }
    </style>
    <script type="text/javascript">
        window.print();
        //window.close();
    </script>
</head>
<body>
	<h3 align="center"><u>DAFTAR RIWAYAT HIDUP</u></h3>

	<h4>I. Keterangan Perorangan</4>
	<table width="100%" border='1'>
		<tr>
			<td width="5%">1.</td>
			<td width="40%" colspan="2">Nama Lengkap</td>
			<td width="55%">

<?php
use app\components\Helper;
?>

<?= $model['nama_lengkap']; ?></td>
		</tr>
		<tr>
			<td width="5%">2.</td>
			<td width="40%" colspan="2">N.I.P</td>
			<td width="55%"><?= $model['id_nip_nrp'] ?></td>
		</tr>
		<tr>
			<td width="5%">3.</td>
			<td width="40%" colspan="2">Pangkat dan Golongan Ruang</td>
			<td width="55%"><?= Helper::getGolongan($model['kode_pangkat']); ?></td>
		</tr>
		<tr>
			<td width="5%">4.</td>
			<td width="20%" rowspan="2">Tempat / Tgl Lahir</td>
			<td width="20%">a. Tempat Lahir</td>
			<td width="55%"><?= $model['tempat_lahir'] ?></td>
		</tr>
		<tr>
			<td width="5%">5.</td>
			<td width="40%">b. Tanggal Lahir</td>
			<td width="55%"><?= $model['tanggal_lahir'] ?></td>
		</tr>
		<tr>
			<td width="5%">6.</td>
			<td width="40%" colspan="2">Jenis Kelamin</td>
			<td width="55%"><?= $model['jenis_kelamin'] ?></td>
		</tr>
		<tr>
			<td width="5%">7.</td>
			<td width="40%" colspan="2">Agama</td>
			<td width="55%"><?= Helper::getAgama($model['agama']); ?></td>
		</tr>
		<tr>
			<td width="5%">8.</td>
			<td width="40%" colspan="2">Status Perkawinan</td>
			<td width="55%"><?= $model['status_perkawinan'] ?></td>
		</tr>
		<tr>
			<td width="5%">9.</td>
			<td width="20%" rowspan="5">Alamat Rumah</td>
			<td width="20%">a. Jalan</td>
			<td width="55%"><?= $model['alamat_tempat_tinggal']; ?></td>
		</tr>
		<tr>
			<td width="5%">10.</td>
			<td width="40%">b. Desa / Kelurahan</td>
			<td width="55%"><?= Helper::getKelurahan($model['desa_kelurahan']); ?></td>
		</tr>
		<tr>
			<td width="5%">11.</td>
			<td width="40%">c. Kecamatan</td>
			<td width="55%"><?= Helper::getKecamatan($model['kecamatan']); ?></td>
		</tr>
		<tr>
			<td width="5%">12.</td>
			<td width="40%">d. Kabupaten / Kota</td>
			<td width="55%"><?= Helper::getKabupaten($model['kabupaten_kota']); ?></td>
		</tr>
		<tr>
			<td width="5%">13.</td>
			<td width="40%">e. Provinsi</td>
			<td width="55%"><?= Helper::getProvinsi($model['provinsi']); ?></td>
		</tr>
		<tr>
			<td width="5%">14.</td>
			<td width="20%" rowspan="7">Keterangan Badan</td>
			<td width="20%">a. Tinggi</td>
			<td width="55%"><?= $model['tinggi_keterangan_badan']; ?></td>
		</tr>
		<tr>
			<td width="5%">15.</td>
			<td width="40%">b. Berat Badan</td>
			<td width="55%"><?= $model['berat_badan_keterangan_badan']; ?></td>
		</tr>
		<tr>
			<td width="5%">16.</td>
			<td width="40%">c. Rambut</td>
			<td width="55%"><?= $model['rambut_keterangan_badan']; ?></td>
		</tr>
		<tr>
			<td width="5%">17.</td>
			<td width="40%">d. Bentuk Muka</td>
			<td width="55%"><?= $model['bentuk_muka_keterangan_badan']; ?></td>
		</tr>
		<tr>
			<td width="5%">18.</td>
			<td width="40%">e. Warna Kulit</td>
			<td width="55%"><?= $model['warna_kulit_keterangan_badan']; ?></td>
		</tr>
		<tr>
			<td width="5%">19.</td>
			<td width="40%">d. Ciri Khas</td>
			<td width="55%"><?= $model['ciri_ciri_khas_keterangan_badan']; ?></td>
		</tr>
		<tr>
			<td width="5%">20.</td>
			<td width="40%">e. Cacat Tubuh</td>
			<td width="55%"><?= $model['cacat_tubuh_keterangan_badan']; ?></td>
		</tr>
		<tr>
			<td width="5%">21.</td>
			<td width="40%" colspan="2">Kegemaran (Hobby)</td>
			<td width="55%"><?= $model['kegemaran_1']." ".$model['kegemaran_2']." ".$model['kegemaran_3']; ?></td>
		</tr>
	</table>	
		

	<h4>II. Pendidikan</h4>
	1. Pendidikan Didalam Dan Diluar Negeri
	<table width="100%" border='1'>
		<tr>
			<th>No</th>
			<th>Tingkat</th>
			<th>Nama Pendidikan</th>
			<th>Jurusan</th>
			<th>STTB/Tanda Lulus/Tahun Ijazah</th>
			<th>Tempat</th>
		</tr>
		<?php
			$no=1;
			foreach ($pendidikan as $dt_pddkn) {	
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $dt_pddkn->tingkat_pendidikan ?></td>
			<td><?= $dt_pddkn->nama_lembaga_pendidikan ?></td>
			<td><?= $dt_pddkn->jurusan_pendidikan ?></td>
			<td><?= $dt_pddkn->nomor_sttb." / ".$dt_pddkn->tanggal_sttb ?></td>
			<td><?= $dt_pddkn->tempat ?></td>
		</tr>
		<?php 
		$no++;
		} ?>
	</table>	
	<br/>
	
	2. Kursus / Latihan Didalam Dan  Diluar Negeri
	<table width="100%" border='1'>
		<tr>
			<th>No</th>
			<th>No Piagam / Sertifikat</th>
			<th>Tgl Piagam / Sertifikat</th>
			<th>Nama Kursus</th>
			<th>Tempat Kursus</th>
			<th>Penyelenggara</th>
			<th>Angkatan</th>
			<th>Jenis</th>
			<th>Tgl Mulai</th>
			<th>Tgl Selesai</th>
		</tr>
		<?php
			$no=1;
			foreach ($kursus as $dt_kursus) {	
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $dt_kursus->nomor_piagam_setifikat ?></td>
			<td><?= $dt_kursus->tanggal_piagam_setifikat ?></td>
			<td><?= $dt_kursus->nama_kursus ?></td>
			<td><?= $dt_kursus->tempat_kursus ?></td>
			<td><?= $dt_kursus->penyelenggara ?></td>
			<td><?= $dt_kursus->angkatan ?></td>
			<td><?= $dt_kursus->jenis ?></td>
			<td><?= $dt_kursus->tgl_mulai ?></td>
			<td><?= $dt_kursus->tgl_selesai ?></td>
		</tr>
		<?php 
		$no++;
		} ?>
	</table>
	
	<h4>III. Riwayat Pekerjaan</h4>
	1.  Riwayat Kepangkatan Golongan Rruang Penggajian
	<table width="100%" border='1'>
		<tr>
			<th>No</th>
			<th>Kode Panggkat</th>
			<th>TMT Pangkat</th>
			<th>Pejabat Penetap</th>
			<th>SK Nomor</th>
			<th>SK Tanggal</th>
			<th>Jenis Kenaikan Pangkat</th>
			<th>Gaji Pokok</th>
			<th>Peraturan Yang Mendasari</th>
			<th>Jumlah Angka Kredit</th>
		</tr>
		<?php
			$no=1;
			foreach ($pangkat as $dt_pangkat) {	
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= Helper::getGolongan($dt_pangkat->kode_pangkat) ?></td>
			<td><?= $dt_pangkat->tmt_pangkat ?></td>
			<td><?= $dt_pangkat->pejabat_yang_menetapkan_pangkat ?></td>
			<td><?= $dt_pangkat->sk_nomor_pangkat ?></td>
			<td><?= $dt_pangkat->sk_tanggal_pangkat ?></td>
			<td><?= Helper::getJnsnaikpangkat($dt_pangkat->jenis_kenaikan_pangkat) ?></td>
			<td><?= $dt_pangkat->gaji_pokok ?></td>
			<td><?= $dt_pangkat->peraturan_yang_mendasari ?></td>
			<td><?= $dt_pangkat->jumlah_angka_kredit ?></td>
		</tr>
		<?php 
		$no++;
		} ?>
	</table>
	<br/>
	
	2. Pengalaman Jabatan / Pekerjaan
	<table width="100%" border='1'>
		<tr>
			<th>No</th>
			<th>Jenis Jabatan</th>
			<th>Kode Jabatan</th>
			<th>Eselon</th>
			<th>TMT Jabatan</th>
			<th>Pejabat Penetap</th>
			<th>SK Pelantikan Nomor</th>
			<th>SK Pelantikan Tanggal</th>
			<th>SK Pernyataan Tanggal</th>
			<th>Sumpah Jabatan</th>
			<th>Kode Gol</th>
			<th>Kode Sub Unit</th>
		</tr>
		<?php
			$no=1;
			foreach ($jabatan as $dt_jabatan) {	
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= Helper::getJnsjabatan($dt_jabatan->jenis_jabatan_id) ?></td>
			<td><?= $dt_jabatan->kode_jabatan ?></td>
			<td><?= $dt_jabatan->eselon_id ?></td>
			<td><?= $dt_jabatan->tmt_jabatan ?></td>
			<td><?= $dt_jabatan->pejabat_yang_menetapkan ?></td>
			<td><?= $dt_jabatan->sk_pelantikan_nomor ?></td>
			<td><?= $dt_jabatan->sk_pelantikan_tanggal ?></td>
			<td><?= $dt_jabatan->sk_pernyataan_tanggal ?></td>
			<td><?= $dt_jabatan->sumpah_jabatan ?></td>
			<td><?= Helper::getGolongan($dt_jabatan->kode_gol) ?></td>
			<td><?= $dt_jabatan->kode_subunit ?></td>
		</tr>
		<?php 
		$no++;
		} ?>
	</table>	
	
	<h4>IV. Tanda Jasa / Penghargaan</h4>
	<table width="100%" border='1'>
		<tr>
			<th>No</th>
			<th>SK Nomor</th>
			<th>SK Tanggal</th>
			<th>Nama Tanda Jasa</th>
			<th>Tahun</th>
			<th>Asal Perolehan</th>
		</tr>
		<?php
			$no=1;
			foreach ($tandajasa as $dt_tandajasa) {	
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $dt_tandajasa->sk_nomor ?></td>
			<td><?= $dt_tandajasa->sk_tanggal ?></td>
			<td><?= $dt_tandajasa->nama_tanda_jasa ?></td>
			<td><?= $dt_tandajasa->tahun ?></td>
			<td><?= $dt_tandajasa->asal_perolehan ?></td>
		</tr>
		<?php 
		$no++;
		} ?>
	</table>
</body>
</html>