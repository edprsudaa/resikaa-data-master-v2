<?php


namespace app\components;


use app\models\DataMasterStatusKepegawain;
use app\models\Sesi;
use app\models\TbPegawai;
use app\components\GoogleCalendar;
use app\models\Absensi;
use app\models\RiwayatPenempatan;

class HelperSso
{


	public $nip;
	public $nips;
	public $date;
	public $date_end;
	public $mulai;
	public $selesai;
	public $dump;

	public function __construct($nip = null, $nips = [], $date = null, $mulai = null, $selesai = null)
	{
		$this->nip = $nip;
		$this->nips = $nips;
		$this->date = $date;
		$this->mulai = $mulai;
		$this->selesai = $selesai;
	}
	const TypeUser = [
		'ROOT' => 'ROOT',
		'MEDIS' => 'MEDIS',
		'NONMEDIS' => 'NONMEDIS',
		'APLIKASI' => 'APLIKASI',
		'Eksternal' => 'Eksternal',
		'Keperawatan' => 'KEPERAWATAN'
	];

	const TypeUserStatus = [
		'0' => 'Pending',
		'1' => 'Aktif',
		'2' => 'Tidak Aktif'
	];



	public static function getDataPegawai()
	{
		$sso = \app\models\AkunAknUser::find()->select('id_pegawai')->all();

		$array = [];
		foreach ($sso as $v) {
			$array[] = $v->id_pegawai;
		}


		$r = TbPegawai::find()->where(['not in', 'pegawai_id', $array])->where(['status_aktif_pegawai'=>1])
			->orderBy(['nama_lengkap' => SORT_ASC])
			->all();

		return $r;
	}


	public static function getDataPegawaiByNip($id)
	{
		$r = TbPegawai::find()->where(['pegawai_id' => $id])->one();
		// if ($r) {
		// }
		return $r;
	}

	static function getLogLogin($id)
	{
		$r = Sesi::find()->where(['ida' => $id])->orderBy(['tgb' => SORT_DESC])->limit(5)->all();
		return $r;
	}

	/**
	 * @return array date hari libur nasional
	 */
	public function cekNationalFreeDay($m = null)
	{
		$Y = date('Y', strtotime(date('Y')));

		if (is_null($m)) {
			$m = date('m');
		}
		$calendar = new GoogleCalendar();
		$holiday = $calendar->getHolidayThisMonth($Y, $m);
		$date = [];
		foreach ($holiday as $key => $value) {
			array_push($date, $key);
		}
		return $date;
	}

	// /**
	//  * @param $add penambahan hari ketika hari dalam seminggu habis
	//  * @param $delay delay pengecekan hari kerja dimulai
	//  * @return array
	//  */
	// public function getHariKerja($add, $delay = 0)
	// {
	// 	$start = date('Y-m-d');

	// 	$start = date('Y-m-d', strtotime("+$delay days", strtotime($start)));

	// 	$dayinweek = date('w');
	// 	$thisweek = $add - $dayinweek;
	// 	$untilnextweek = $thisweek + $add;
	// 	$end = date('Y-m-d', strtotime('+' . $untilnextweek . ' days', strtotime($start)));
	// 	$this->date_end = $end;

	// 	$buka_range_jadwal = $this->createDateRangeArray($start, $end);

	// 	/** @var y-m-d arr $hasil selisih antara range set jadwal dengan jadwal libur nasional */
	// 	$hasil = array_diff($buka_range_jadwal, $this->cekNationalFreeDay());

	// 	/** @var y-m-d arr $worksday waktu kerja (bukan waktu weekend dan libur nasional ) */
	// 	$worksday = [];
	// 	foreach ($hasil as $item) {
	// 		$toweek = date('w Y-m-d', strtotime($item));
	// 		//            0 adalah hari minggu dan 6 adalah sabtu
	// 		if ($toweek[0] == '0' || $toweek[0] == '6') {
	// 			unset($toweek);
	// 		} else {
	// 			array_push($worksday, $item);
	// 		}
	// 	}
	// 	return $worksday;
	// }

	public function createDateRangeArray($start, $end)
	{
		$result = array();
		$dari = mktime(1, 0, 0, substr($start, 5, 2), substr($start, 8, 2), substr($start, 0, 4));
		$sampai = mktime(1, 0, 0, substr($end, 5, 2), substr($end, 8, 2), substr($end, 0, 4));
		if ($sampai >= $dari) {
			array_push($result, date('Y-m-d', $dari)); // first entry
			while ($dari < $sampai) {
				$dari += 86400; // add 24 hours in seconds
				array_push($result, date('Y-m-d', $dari));
			}
		}
		return $result;
	}

	/**
	 * @return array jam kerja
	 */
	public function getJamKerja()
	{
		$jamkerja = [
			['07:30:00', '12:45:00'],
			['13:00:00', '16:00:00'],
		];

		$jamkerjamenit = [];
		foreach ($jamkerja as $item) {
			$range = [];
			foreach ($item as $time) {

				$time = Konversi::setTimesMinutes($time);
				array_push($range, $time);
			}
			array_push($jamkerjamenit, $range);
		}

		return $jamkerjamenit;
	}

	static function tgl_indo($tanggal)
	{
		$bulan = array(
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);

		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun

		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}

	static function hari_ini($d)
	{
		$hari = $d;

		switch ($hari) {
			case 'Sun':
				$hari_ini = "Minggu";
				break;

			case 'Mon':
				$hari_ini = "Senin";
				break;

			case 'Tue':
				$hari_ini = "Selasa";
				break;

			case 'Wed':
				$hari_ini = "Rabu";
				break;

			case 'Thu':
				$hari_ini = "Kamis";
				break;

			case 'Fri':
				$hari_ini = "Jumat";
				break;

			case 'Sat':
				$hari_ini = "Sabtu";
				break;

			default:
				$hari_ini = "Tidak di ketahui";
				break;
		}

		return $hari_ini;
	}

	static function menghitung_selisih($waktu_awal, $waktu_akhir)
	{
		$awl = strtotime($waktu_awal);
		$akh = strtotime($waktu_akhir); // bisa juga waktu sekarang now()
		//menghitung selisih dengan hasil detik
		$diff = $awl - $akh;

		//membagi detik menjadi jam
		$jam = floor($diff / (60 * 60));

		//membagi sisa detik setelah dikurangi $jam menjadi menit
		$menit = $diff - $jam * (60 * 60);

		return $jam . " Jam dan " . floor($menit / 60) . " Menit";
	}

	static function menghitung_jumlah_ovt($waktu_jam_pulang, $waktu_normal)
	{
		$awl = strtotime($waktu_jam_pulang);
		$akh = strtotime($waktu_normal); // bisa juga waktu sekarang now()
		//menghitung selisih dengan hasil detik
		$diff = $awl - $akh;

		//membagi detik menjadi jam
		$jam = floor($diff / (60 * 60));

		//membagi sisa detik setelah dikurangi $jam menjadi menit
		$menit = $diff - $jam * (60 * 60);

		if ($jam == 0) {
			return floor($menit / 60);
		} else {

			return $jam . " Jam dan " . floor($menit / 60) . " Menit";
		}
	}

	static function menghitung_jumlah_cpt_pulang($waktu_jam_pulang, $waktu_normal)
	{
		$awl = strtotime($waktu_normal);
		$akh = strtotime($waktu_jam_pulang); // bisa juga waktu sekarang now()
		//menghitung selisih dengan hasil detik
		$diff = $awl - $akh;

		//membagi detik menjadi jam
		$jam = floor($diff / (60 * 60));

		//membagi sisa detik setelah dikurangi $jam menjadi menit
		$menit = $diff - $jam * (60 * 60);

		if ($jam == -1) {
			return floor($menit / 60);
		} else {

			return floor($menit / 60);
		}
	}

	static function menghitung_jumlah_tlt_datang($waktu_jam_pulang, $waktu_normal)
	{
		$awl = strtotime($waktu_jam_pulang);
		$akh = strtotime($waktu_normal); // bisa juga waktu sekarang now()
		//menghitung selisih dengan hasil detik
		$diff = $awl - $akh;

		//membagi detik menjadi jam
		$jam = floor($diff / (60 * 60));

		//membagi sisa detik setelah dikurangi $jam menjadi menit
		$menit = $diff - $jam * (60 * 60);

		if ($jam == -1) {
			return floor($menit / 60);
		} else {

			return floor($menit / 60);
		}
	}


	static function menghitungTotalHadir($d)
	{
		$hari_ini = date("Y-m-d", strtotime('-1 month'));
		$tgl_pertama = date('Y-m-01', strtotime($hari_ini));
		$tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

		$modal = Absensi::find()->where(['nip_nik' => $d, 'status' => 'h'])
			->andWhere(['between', 'DATE(tanggal_masuk)', $tgl_pertama, $tgl_terakhir])
			->count('nip_nik');
		return $modal;
	}

	static function menghitungTotalAlfa($d)
	{
		$hari_ini = date("Y-m-d", strtotime('-1 month'));
		$tgl_pertama = date('Y-m-01', strtotime($hari_ini));
		$tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

		$modal = Absensi::find()->where(['nip_nik' => $d, 'status' => 'a'])
			->andWhere(['between', 'DATE(tanggal_masuk)', $tgl_pertama, $tgl_terakhir])
			->count('nip_nik');
		return $modal;
	}
	static function menghitungTotalIzin($d)
	{
		$hari_ini = date("Y-m-d", strtotime('-1 month'));
		$tgl_pertama = date('Y-m-01', strtotime($hari_ini));
		$tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

		$modal = Absensi::find()->where(['nip_nik' => $d])
			->andWhere(['in', 'status', ['i', 'ib']])
			->andWhere(['between', 'DATE(tanggal_masuk)', $tgl_pertama, $tgl_terakhir])
			->count('nip_nik');
		return $modal;
	}

	static function getRiwayatPenempatan($p)
	{
		$v = RiwayatPenempatan::findOne($p);
		return $v;
	}

	static function getJamMasukJamKeluarPegawai($nip)
	{
		$absen = Absensi::find()->where(['tanggal_masuk' => date('Y-m-d')])->andWhere(['nip_nik' => $nip])->one();
		return $absen;
	}
}
