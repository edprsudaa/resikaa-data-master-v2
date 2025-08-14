<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_riwayat_spklinis".
 *
 * @property int $id
 * @property string $id_nip_nrp
 * @property string $nomor_spk
 * @property string $nomor_str
 * @property string $tingkat_klinik
 * @property string $tanggal_terbit
 * @property string $tanggal_berlaku
 * @property string $dokumen
 */
class RiwayatSpklinis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        // return 'sip.tb_riwayat_spklinis';
        return 'pegawai.tb_riwayat_spklinis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nip_nrp', 'nomor_spk', 'nomor_str', 'tingkat_klinik', 'tanggal_terbit', 'tanggal_berlaku'], 'required'],
            [['tanggal_terbit', 'tanggal_berlaku'], 'safe'],
            [['dokumen'], 'string'],
            [['id_nip_nrp', 'nomor_spk', 'nomor_str', 'tingkat_klinik'], 'string', 'max' => 30],
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
            'nomor_spk' => 'Nomor Spk',
            'nomor_str' => 'Nomor Str',
            'tingkat_klinik' => 'Tingkat Klinik',
            'tanggal_terbit' => 'Tanggal Terbit',
            'tanggal_berlaku' => 'Tanggal Berlaku',
            'dokumen' => 'Dokumen',
        ];
    }
}
