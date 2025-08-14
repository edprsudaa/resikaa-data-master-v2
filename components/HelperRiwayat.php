<?php 

namespace app\components;

use app\models\Pegawai;
use app\models\RiwayatJabatan;
use app\models\RiwayatKepangkatan;
use app\models\RiwayatPendidikan;
use app\models\RiwayatPenempatan;
use app\models\IssueKeterangan;
use app\models\UnitPltPlh;
use DateTime;

class HelperRiwayat{

    // static function getGolongan($p)
    // {
    //     $v = Golongan::findOne($p);
    //     return $v;
    // }
    
    // static function getGol($p)
    // {
    //     $v = Golongan::findOne($p);
    //     return $v['kode'] = $v['golongan'];
    // }
    
    // static function getRuang($p)
    // {
    //     $v = Golongan::findOne($p);
    //     return $v['kode'] = $v['pangkat'];
    // }
    
    static function getRiwayatJabatan($p)
    {
        $v = RiwayatJabatan::findOne($p);
        return $v;
    }
    
    static function getRiwayatPenempatan($p)
    {
        $v = RiwayatPenempatan::findOne($p);
        return $v;
    }
    
}