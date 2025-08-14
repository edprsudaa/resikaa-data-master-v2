<?php

namespace app\components;

use app\models\UNIT;
use app\models\User;
use app\models\Jabatan;
use app\models\TindKel;
use app\models\Pelanggan;
use app\models\TipeKamar;
use app\models\MedisKamar;
use app\models\PaketKamar;
use app\models\RiwayatStr;
use app\models\RiwayatSipp;
use app\models\MedisAnatomi;
use app\models\MedisSkTarif;
use yii\helpers\ArrayHelper;
use app\models\MedisTindakan;
use app\models\RiwayatSpklinis;
use app\models\UnitSubPenempatan;
use app\models\MedisMasterTindakan;
use app\models\PegawaiUnitPenempatan;
use app\models\PendaftaranKelasRawat;
use app\models\PegawaiUnitSubPenempatan;

class Helper
{

    // static function getUnit($p)
    // {
    //     $v = UNIT::findOne($p);
    //     return $v;
    // }

    static function getUnit($p)
    {
        $v = UNIT::findOne($p);
        return $v['KD_INST'] = $v['KET'];
    }

    static function getTindkel($p)
    {
        $v = TindKel::findOne($p);
        return $v['KDKEL'] = $v['KDKEL'] . " | " . $v['KELOMPOK'];
    }

    static function getTindakan($p)
    {
        if (!empty($p)) {
            $data = \Yii::$app->db->createCommand("WITH RECURSIVE rec_tindakan AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM medis.tindakan as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
                   rec_tindakan.rumpun || ' -> ' || b.deskripsi
            FROM medis.tindakan as b
               JOIN rec_tindakan ON b.parent_id = rec_tindakan.id
      )
      SELECT * FROM rec_tindakan where id =$p")->queryOne();

            return $data['id'] = $data['rumpun'];
        } else {
            return $data['id'] = '';
        }
    }

    static function getAnatomi($p)
    {
        if (!empty($p)) {
            $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_anatomi AS (
            SELECT a.id_anatomi, a.parent_id, a.nama_latin, a.nama_latin AS rumpun
            FROM " . MedisAnatomi::tableName() . " as a
            WHERE a.parent_id IS NULL
            UNION ALL
            SELECT b.id_anatomi, b.parent_id, b.nama_latin,
            (rec_anatomi.rumpun || ' -> ' || b.nama_latin)::varchar(512)
            FROM " . MedisAnatomi::tableName() . " as b
            JOIN rec_anatomi ON b.parent_id = rec_anatomi.id_anatomi
            )

        SELECT * FROM rec_anatomi where id_anatomi =$p")->queryOne();

            return $data['id_anatomi'] = $data['rumpun'];
        } else {
            return $data['id_anatomi'] = '';
        }
    }

    static function getIcd9Cm($p)
    {
        if (!empty($p)) {
            $data = \Yii::$app->db->createCommand("WITH RECURSIVE rec_icd9cm AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM medis.icd9cm as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
            rec_icd9cm.rumpun || ' -> ' || b.deskripsi
            FROM medis.icd9cm as b
               JOIN rec_icd9cm ON b.parent_id = rec_icd9cm.id
      )
      SELECT * FROM rec_icd9cm where id =$p")->queryOne();

            return $data['id'] = $data['rumpun'];
        } else {
            return $data['id'] = '';
        }
    }

    static function getIcd10Cm($p)
    {
        if (!empty($p)) {
            $data = \Yii::$app->db->createCommand("WITH RECURSIVE rec_icd10cm AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM medis.icd10cm as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
            rec_icd10cm.rumpun || ' -> ' || b.deskripsi
            FROM medis.icd10cm as b
               JOIN rec_icd10cm ON b.parent_id = rec_icd10cm.id
      )
      SELECT * FROM rec_icd10cm where id =$p")->queryOne();

            return $data['id'] = $data['rumpun'];
        } else {
            return $data['id'] = '';
        }
    }

    static function getMasalahKeperawatan($p)
    {
        if (!empty($p)) {
            $data = \Yii::$app->db->createCommand("WITH RECURSIVE rec_mslh_keperawatan AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM medis.masalah_keperawatan as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
            rec_mslh_keperawatan.rumpun || ' -> ' || b.deskripsi
                FROM medis.masalah_keperawatan as b
                   JOIN rec_mslh_keperawatan ON b.parent_id = rec_mslh_keperawatan.id
          )
          SELECT * FROM rec_mslh_keperawatan where id =$p")->queryOne();

            return $data['id'] = $data['rumpun'];
        } else {
            return $data['id'] = '';
        }
    }

    static function getIntervensiKeperawatan($p)
    {
        if (!empty($p)) {
            $data = \Yii::$app->db->createCommand("WITH RECURSIVE rec_intervensi_keperawatan AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM medis.intervensi_keperawatan as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
            rec_intervensi_keperawatan.rumpun || ' -> ' || b.deskripsi
                FROM medis.intervensi_keperawatan as b
                   JOIN rec_intervensi_keperawatan ON b.parent_id = rec_intervensi_keperawatan.id
          )
          SELECT * FROM rec_intervensi_keperawatan where id =$p")->queryOne();

            return $data['id'] = $data['rumpun'];
        } else {
            return $data['id'] = '';
        }
    }

    static function getSkTarif($p)
    {
        if (!empty($p)) {
            $v = MedisSkTarif::findOne($p);
            return $v['id'] = $v['nomor'];
        } else {
            return $v['id'] = '';
        }
    }

    static function getKelasRawat($p)
    {
        if (!empty($p)) {
            $v = PendaftaranKelasRawat::findOne($p);
            return $v['kode'] = $v['nama'];
        } else {
            return $v['kode'] = '';
        }
    }

    static function getKamarUnit($p)
    {
        if (!empty($p)) {
            $v = MedisKamar::findOne($p);
            return $v['id'] = Helper::getUnitPenempatan($v['unit_id']) . " / " . Helper::getKelasRawat($v['kelas_rawat_kode']) . " / " . $v['no_kamar'] . " / " . $v['no_kasur'];
        } else {
            return $v['id'] = '';
        }
    }

    //Data Jabatan
    static function getJabatan($p)
    {
        if (!empty($p)) {
            $v = Jabatan::findOne($p);
            return $v['kode'] = $v['nama_jabatan'];
        } else {
            return $v['kode'] = '';
        }
    }

    //Data Penempatan
    static function getUnitPenempatan($p)
    {
        if (!empty($p)) {
            $v = PegawaiUnitPenempatan::findOne($p);
            return $v['kode'] = $v['nama'];
        } else {
            return $v['kode'] = '';
        }
    }

    static function getUnitSubPenempatan($p)
    {
        if (!empty($p)) {
            $v = PegawaiUnitSubPenempatan::findOne($p);
            return $v['kode'] = $v['nama'];
        } else {
            return $v['kode'] = '';
        }
    }

    static function KelompokTindakan($p)
    {
        if (!empty($p)) {
            $v = MedisMasterTindakan::findOne($p);
            return $v['deskripsi'] = $v['id_tindakan'];
        } else {
            return $v['deskripsi'] = '';
        }
    }


    static function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    static function angkaRomawi($angka)
    {
        $angka = intval($angka);
        $result = '';
        
        $array = array('M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1);
        
        foreach($array as $roman => $value){
        $matches = intval($angka/$value);
        
        $result .= str_repeat($roman,$matches);
        
        $angka = $angka % $value;
        }
        
        return $result;
    }
}
