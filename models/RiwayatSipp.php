<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_riwayat_sipp".
 *
 * @property int $id
 * @property string $id_nip_nrp
 * @property string $nomor_sipp
 * @property string $nomor_strp
 * @property string $tanggal_terbit
 * @property string $tanggal_berlaku
 * @property string $dokumen
 */
class RiwayatSipp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        // return 'sip.tb_riwayat_sipp';
        return 'pegawai.tb_riwayat_sipp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nip_nrp', 'nomor_sipp', 'nomor_strp', 'tanggal_terbit', 'tanggal_berlaku'], 'required'],
            [['tanggal_terbit', 'tanggal_berlaku'], 'safe'],
            [['dokumen'], 'string'],
            [['id_nip_nrp', 'nomor_sipp', 'nomor_strp'], 'string', 'max' => 30],
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
            'nomor_sipp' => 'Nomor Sipp',
            'nomor_strp' => 'Nomor Strp',
            'tanggal_terbit' => 'Tanggal Terbit',
            'tanggal_berlaku' => 'Tanggal Berlaku',
            'dokumen' => 'Dokumen',
        ];
    }
}
