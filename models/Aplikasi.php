<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "akun.akn_app".
 *
 * @property int $id
 * @property string $nma nama aplikasi
 * @property string|null $inf Deskripsi Aplikasi
 * @property string $prm Permission Name
 * @property string|null $icn File Icon
 * @property string $lnk Link Aplikasi
 * @property string $kda Kode Akses
 * @property bool $sta Status (0=Tidak Aktif, 1=Aktif)
 * @property string $crd
 * @property string $mdd
 */
class Aplikasi extends \yii\db\ActiveRecord
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNma()
    {
        return $this->nma;
    }

    /**
     * @param string $nma
     */
    public function setNma($nma)
    {
        $this->nma = $nma;
    }

    /**
     * @return string|null
     */
    public function getInf()
    {
        return $this->inf;
    }

    /**
     * @param string|null $inf
     */
    public function setInf($inf)
    {
        $this->inf = $inf;
    }

    /**
     * @return string
     */
    public function getPrm()
    {
        return $this->prm;
    }

    /**
     * @param string $prm
     */
    public function setPrm($prm)
    {
        $this->prm = $prm;
    }

    /**
     * @return string|null
     */
    public function getIcn()
    {
        return $this->icn;
    }

    /**
     * @param string|null $icn
     */
    public function setIcn($icn)
    {
        $this->icn = $icn;
    }

    /**
     * @return string
     */
    public function getLnk()
    {
        return $this->lnk;
    }

    /**
     * @param string $lnk
     */
    public function setLnk($lnk)
    {
        $this->lnk = $lnk;
    }

    /**
     * @return string
     */
    public function getKda()
    {
        return $this->kda;
    }

    /**
     * @param string $kda
     */
    public function setKda($kda)
    {
        $this->kda = $kda;
    }

    /**
     * @return bool
     */
    public function isSta()
    {
        return $this->sta;
    }

    /**
     * @param bool $sta
     */
    public function setSta($sta)
    {
        $this->sta = $sta;
    }

    /**
     * @return string
     */
    public function getCrd()
    {
        return $this->crd;
    }

    /**
     * @param string $crd
     */
    public function setCrd($crd)
    {
        $this->crd = $crd;
    }

    /**
     * @return string
     */
    public function getMdd()
    {
        return $this->mdd;
    }

    /**
     * @param string $mdd
     */
    public function setMdd($mdd)
    {
        $this->mdd = $mdd;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sso.akn_app';
    }

   
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nma', 'prm', 'lnk', 'kda', 'sta', 'crd', 'mdd'], 'required'],
            [['inf', 'lnk'], 'string'],
            [['sta'], 'boolean'],
            [['crd', 'mdd'], 'safe'],
            [['nma', 'prm', 'icn'], 'string', 'max' => 64],
            [['kda'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nma' => 'Nama Aplikasi',
            'inf' => 'Deskripsi Aplikasi',
            'prm' => 'Permission Name',
            'icn' => 'File Icon',
            'lnk' => 'Link Aplikasi',
            'kda' => 'Kode Akses',
            'sta' => 'Status Aplikasi',
            'crd' => 'Tanggal Didaftarkan',
            'mdd' => 'Mdd',
        ];
    }
}
