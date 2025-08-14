<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_riwayat_str".
 *
 * @property int $id
 * @property string $id_nip_nrp
 * @property string $no_registrasi
 * @property string $kompetensi
 * @property string $no_srt_kompetensi
 * @property string $tanggal_terbit
 * @property string $tanggal_berlaku
 * @property string $dokumen
 */
class RiwayatStr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        // return 'sip.tb_riwayat_str';
        return 'pegawai.tb_riwayat_str';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nip_nrp', 'no_registrasi', 'kompetensi', 'no_srt_kompetensi', 'tanggal_terbit', 'tanggal_berlaku'], 'required'],
            [['tanggal_terbit', 'tanggal_berlaku'], 'safe'],
            [['dokumen'], 'string'],
            [['id_nip_nrp', 'no_registrasi', 'kompetensi', 'no_srt_kompetensi'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nip_nrp' => 'Id Nip Nipk',
            'no_registrasi' => 'No Registrasi',
            'kompetensi' => 'Kompetensi',
            'no_srt_kompetensi' => 'No Srt Kompetensi',
            'tanggal_terbit' => 'Tanggal Terbit',
            'tanggal_berlaku' => 'Tanggal Berlaku',
            'dokumen' => 'Dokumen',
        ];
    }
}
