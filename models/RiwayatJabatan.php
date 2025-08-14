<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_riwayat_jabatan".
 *
 * @property int $id
 * @property string $nip
 * @property int|null $jenis_jabatan_id
 * @property string|null $kode_jabatan
 * @property int|null $eselon_id
 * @property string|null $tmt_jabatan
 * @property string|null $pejabat_yang_menetapkan
 * @property string|null $sk_pelantikan_nomor
 * @property string|null $sk_pelantikan_tanggal
 * @property string|null $sk_pernyataan_tanggal
 * @property string|null $sumpah_jabatan
 * @property string|null $kode_gol
 * @property string|null $dokumen
 */
class RiwayatJabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        // return 'sip.tb_riwayat_jabatan';
        return 'pegawai.tb_riwayat_jabatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'jenis_jabatan_id', 'kode_jabatan', 'eselon_id'], 'required'],
            [['jenis_jabatan_id'], 'default', 'value' => null],
            [['jenis_jabatan_id', 'eselon_id'], 'integer'],
            [['tmt_jabatan', 'sk_pelantikan_tanggal', 'sk_pernyataan_tanggal'], 'safe'],
            [['dokumen'], 'file','extensions'=>'pdf','wrongExtension'=>'Berkas {attribute} harus type {extensions}','maxSize'=>204800,'tooBig'=>'Ukuran file tidak boleh lebih dari 200 KiloByte (KB)','skipOnEmpty'=>true,'enableClientValidation'=>true],
            [['nip', 'sk_pelantikan_nomor'], 'string', 'max' => 30],
            [['kode_jabatan'], 'string', 'max' => 10],
            [['pejabat_yang_menetapkan'], 'string', 'max' => 50],
            [['sumpah_jabatan', 'kode_gol'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'jenis_jabatan_id' => 'Jenis Jabatan ID',
            'kode_jabatan' => 'Kode Jabatan',
            'eselon_id' => 'Eselon ID',
            'tmt_jabatan' => 'Tmt Jabatan',
            'pejabat_yang_menetapkan' => 'Pejabat Yang Menetapkan',
            'sk_pelantikan_nomor' => 'Sk Pelantikan Nomor',
            'sk_pelantikan_tanggal' => 'Sk Pelantikan Tanggal',
            'sk_pernyataan_tanggal' => 'Sk Pernyataan Tanggal',
            'sumpah_jabatan' => 'Sumpah Jabatan',
            'kode_gol' => 'Kode Gol',
            'dokumen' => 'Dokumen',
        ];
    }
}
