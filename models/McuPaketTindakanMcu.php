<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mcu.paket_tindakan_mcu".
 *
 * @property int $id
 * @property int $kode_paket
 * @property string $kode_tindakan
 * @property string|null $kode_unit
 * @property string|null $nama_tabel
 * @property string|null $nama_kolom1
 * @property string|null $nama_kolom2
 * @property string|null $nama_tindakan
 * @property int|null $harga
 */
class McuPaketTindakanMcu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mcu.paket_tindakan_mcu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_paket', 'kode_tindakan'], 'required'],
            [['kode_paket', 'harga'], 'default', 'value' => null],
            [['id', 'kode_paket', 'harga'], 'integer'],
            [['nama_tabel', 'nama_kolom1', 'nama_kolom2', 'nama_tindakan'], 'string'],
            [['kode_tindakan', 'kode_unit'], 'string', 'max' => 255],
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
            'kode_paket' => 'Kode Paket',
            'kode_tindakan' => 'Kode Tindakan',
            'kode_unit' => 'Kode Unit',
            'nama_tabel' => 'Nama Tabel',
            'nama_kolom1' => 'Nama Kolom1',
            'nama_kolom2' => 'Nama Kolom2',
            'nama_tindakan' => 'Nama Tindakan',
            'harga' => 'Harga',
        ];
    }

    public function getUnit()
    {
        return $this->hasOne(UNIT::className(), ['KD_INST' => 'kode_unit']);
    }

    public function getPaket()
    {
        return $this->hasOne(McuPaket::className(), ['kode' => 'kode_paket']);
    }

    public static function getPaketTindakan() {
        $data = McuPaketTindakanMcu::find()->joinWith('paket')->asArray()->all();
        //$value = (count($data) == 0) ? ['' => ''] : $data;
        $value = [];
        foreach ($data as $s) {

            $d = [
                'id' => $s['id'],
                'name' => $s['paket']['nama'] . " | " . $s['kode_tindakan'] . " | " . $s['nama_tindakan']
            ];
            array_push($value, $d);
        }

        return $value;
    }
}
