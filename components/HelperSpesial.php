<?php

namespace app\components;

use Yii;
use app\models\TbPegawai;
use app\models\AkunAknUser;
use app\models\TbUnitPltPlh;
use yii\helpers\ArrayHelper;
use app\models\PegawaiKsmDetail;
use app\models\RiwayatPenempatan;

class HelperSpesial
{
  const LEVEL_ROOT = 'ROOT';
  const LEVEL_ADMIN = 'ADMIN';
  const LEVEL_PERAWAT = 'PERAWAT';
  const LEVEL_BIDAN = 'BIDAN';
  const LEVEL_DOKTER = 'DOKTER';
  const LEVEL_KETEKNISIAN_MEDIS = 'KETEKNISIAN_MEDIS';
  const LEVEL_ADM = 'ADM';

  const SDM_RUMPUN_MEDIS = '1';
  const SDM_RUMPUN_PERAWAT = '3';
  const SDM_RUMPUN_BIDAN = '4';
  const SDM_RUMPUN_KETEKNISIAN_MEDIS = '10';

  public static function getDataPegawaiByNomor($nomor)
  {
    return TbPegawai::find()->where(['pgw_nomor' => $nomor])->one();
  }
  public static function getDataPegawaiById($id)
  {
    return TbPegawai::find()->where(['pegawai_id' => $id])->one();
  }
 
  public static function getNamaPegawai($pegawai)
  {
    return ($pegawai->gelar_sarjana_depan ? $pegawai->gelar_sarjana_depan . ' ' : null) . $pegawai->nama_lengkap . ($pegawai->gelar_sarjana_belakang ? ', ' . $pegawai->gelar_sarjana_belakang : null);
  }
  public static function getNamaPegawaiArray($pegawai)
  {
    return ($pegawai['gelar_sarjana_depan'] ? $pegawai['gelar_sarjana_depan'] . ' ' : null) . $pegawai['nama_lengkap'] . ($pegawai['gelar_sarjana_belakang'] ? ', ' . $pegawai['gelar_sarjana_belakang'] : null);
  }

  public static function getListUser($aktif = 0, $original = true, $list = false)
  {
    $result = array();
    $query = AkunAknUser::find();
    $query->joinWith([
      'pegawai.riwayatPenempatan.unitKerja'
    ])->orderBy([TbPegawai::tableName() . '.id_nip_nrp' => SORT_DESC]);
    if ($aktif > 0) {
      $query->where([TbPegawai::tableName() . '.status_aktif_pegawai' => 1]);
    }

    // $query->andWhere(['or', [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 1], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 3], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 10]]);
    $result = $query->asArray()->all();

    $list_result = array();
    // echo "<pre>";
    // print_r($result);
    // die;
    foreach ($result as $v) {
      if ($v['pegawai'] != null) {
        array_push($list_result, ['id' => $v['userid'], 'nama' => self::getNamaPegawaiArray($v['pegawai']) . " - " . $v['username']]);
      }
    }

    if ($original) {
      return $list_result;
    } else {
      if ($list) {
        return ArrayHelper::map($list_result, 'id', 'nama');
      } else {
        return ArrayHelper::getColumn($list_result, 'id');
      }
    }
  }
  public static function getListDokter($original = true, $list = false, $excludeKsm = false)
  {
      $query = TbPegawai::find()
          ->select([
              TbPegawai::tableName().'.id_nip_nrp',
              'pegawai_id',
              new \yii\db\Expression(
                  "CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama"
              )
          ])
          ->innerJoinWith([
              'riwayatPenempatan' => function($q) {
                  $q->where([RiwayatPenempatan::tableName().'.sdm_rumpun' => self::SDM_RUMPUN_MEDIS])
                    ->orderBy([RiwayatPenempatan::tableName().'.tanggal' => SORT_DESC])
                    ->active()
                    ->limit(1);
              }
          ])
          ->active();

      // Jika exclude dokter yang sudah ada di pegawai_ksm_detail
      if ($excludeKsm) {
          $pegawaiSudahKsm = PegawaiKsmDetail::find()
              ->select('pegawai_id')
              ->column();
          if (!empty($pegawaiSudahKsm)) {
              $query->andWhere(['NOT IN', TbPegawai::tableName().'.pegawai_id', $pegawaiSudahKsm]);
          }
      }

      $result = $query->asArray()->all();

      if (!$result) {
          $query = TbPegawai::find()
              ->select([
                  TbPegawai::tableName().'.id_nip_nrp',
                  'pegawai_id',
                  new \yii\db\Expression(
                      "CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama"
                  )
              ])
              ->innerJoinWith([
                  'pltPlh' => function($q) {
                      $q->where([TbUnitPltPlh::tableName().'.sdm_rumpun' => self::SDM_RUMPUN_MEDIS])
                        ->orderBy([TbUnitPltPlh::tableName().'.tanggal_surat' => SORT_DESC])
                        ->active()
                        ->limit(1);
                  }
              ])
              ->active();

          if ($excludeKsm) {
              $pegawaiSudahKsm = PegawaiKsmDetail::find()
                  ->select('pegawai_id')
                  ->column();
              if (!empty($pegawaiSudahKsm)) {
                  $query->andWhere(['NOT IN', TbPegawai::tableName().'.pegawai_id', $pegawaiSudahKsm]);
              }
          }

          $result = $query->asArray()->all();
      }

      if ($original) {
          return $result;
      } else {
          if ($list) {
              return ArrayHelper::map($result, 'pegawai_id', 'nama');
          } else {
              return ArrayHelper::getColumn($result, 'pegawai_id');
          }
      }
  }

  public static function getHitungBiayaTindakan($data, $object = true)
  {
    if ($object) {
      return
        [
          'standar' => intval($data->js_adm) + intval($data->js_sarana) + intval($data->js_bhp) + intval($data->js_dokter_operator) + intval($data->js_dokter_lainya) + intval($data->js_dokter_anastesi) + intval($data->js_penata_anastesi) + intval($data->js_paramedis) + intval($data->js_lainya),
          'cyto' => intval($data->js_adm_cto) + intval($data->js_sarana_cto) + intval($data->js_bhp_cto) + intval($data->js_dokter_operator_cto) + intval($data->js_dokter_lainya_cto) + intval($data->js_dokter_anastesi_cto) + intval($data->js_penata_anastesi_cto) + intval($data->js_paramedis_cto) + intval($data->js_lainya_cto)
        ];
    } else {
      return
        [
          'standar' => intval($data['js_adm']) + intval($data['js_sarana']) + intval($data['js_bhp']) + intval($data['js_dokter_operator']) + intval($data['js_dokter_lainya']) + intval($data['js_dokter_anastesi']) + intval($data['js_penata_anastesi']) + intval($data['js_paramedis']) + intval($data['js_lainya']),
          'cyto' => intval($data['js_adm_cto']) + intval($data['js_sarana_cto']) + intval($data['js_bhp_cto']) + intval($data['js_dokter_operator_cto']) + intval($data['js_dokter_lainya_cto']) + intval($data['js_dokter_anastesi_cto']) + intval($data['js_penata_anastesi_cto']) + intval($data['js_paramedis_cto']) + intval($data['js_lainya_cto'])
        ];
    }
  }
}
