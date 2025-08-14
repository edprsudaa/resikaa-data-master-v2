<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mcu.dokter_paket_tindakan_mcu".
 *
 * @property int $id
 * @property int $id_paket_tindakan_mcu
 * @property string $tanggal
 * @property string $kode_dokter
 */
class McuDokterPaketTindakanMcu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mcu.dokter_paket_tindakan_mcu';
    }

    /**
     * {@inheritdoc}
     */

    public $paketnya;
    public function rules()
    {
        return [
            [['id_paket_tindakan_mcu', 'tanggal', 'kode_dokter'], 'required'],
            [['id_paket_tindakan_mcu'], 'default', 'value' => null],
            [['id', 'id_paket_tindakan_mcu'], 'integer'],
            [['tanggal'], 'safe'],
            [['kode_dokter'], 'string'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_paket_tindakan_mcu' => 'Paket Tindakan Mcu',
            'tanggal' => 'Tanggal',
            'kode_dokter' => 'Dokter',
        ];
    }

    public function getTindakan()
    {
        return $this->hasOne(McuPaketTindakanMcu::className(), ['id' => 'id_paket_tindakan_mcu']);
    }
    
    public function getDokter()
    {
        return $this->hasOne(DOKTER::className(), ['KODE' => 'kode_dokter']);
    }
}
