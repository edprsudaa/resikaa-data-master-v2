<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_riwayat_penempatan".
 *
 * @property int $id
 * @property string $id_nip_nrp
 * @property string $nota_dinas
 * @property string $tanggal
 * @property int|null $atasan_langsung
 * @property string $penempatan
 * @property int|null $sdm_rumpun
 * @property int|null $sdm_sub_rumpun
 * @property int|null $sdm_jenis
 * @property string|null $dokumen
 */
class RiwayatPenempatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.tb_riwayat_penempatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_nip_nrp', 'nota_dinas', 'tanggal', 'unit_kerja', 'penempatan'], 'required'],
            [['tanggal'], 'safe'],
            [['unit_kerja', 'atasan_langsung', 'penempatan', 'sdm_rumpun', 'sdm_sub_rumpun', 'sdm_jenis'], 'default', 'value' => null],
            [['unit_kerja', 'atasan_langsung', 'penempatan', 'sdm_rumpun', 'sdm_sub_rumpun', 'sdm_jenis'], 'integer'],
            [['dokumen'], 'string'],
            [['id_nip_nrp'], 'string', 'max' => 30],
            [['nota_dinas'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nip_nrp' => 'Id Nip Nrp',
            'nota_dinas' => 'Nota Dinas',
            'tanggal' => 'Tanggal',
            'unit_kerja' => 'Unit Kerja',
            'atasan_langsung' => 'Atasan Langsung',
            'penempatan' => 'Penempatan',
            'sdm_rumpun' => 'Sdm Rumpun',
            'sdm_sub_rumpun' => 'Sdm Sub Rumpun',
            'sdm_jenis' => 'Sdm Jenis',
            'dokumen' => 'Dokumen',
        ];
    }

    public static function find()
    {
        return new RiwayatPenempatanQuery(get_called_class());
    }
}
