<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mcu.paket".
 *
 * @property int $kode
 * @property string|null $nama
 * @property string|null $is_active
 * @property string|null $kode_debitur kode debitur simrs lama
 * @property string|null $jenis_paket 1=umum, 2=instansi
 */
class McuPaket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mcu.paket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['kode'], 'required'],
            //[['kode'], 'default', 'value' => null],
            [['kode'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['jenis_paket'], 'string', 'max' => 1],
            [['kode_debitur'], 'string', 'max' => 4],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama',
            'is_active' => 'Status',
            'kode_debitur' => 'Kode Debitur',
            'jenis_paket' => 'Jenis Paket',
        ];
    }

    public function getJenPaket()
    {
        if ($this->jenis_paket == 1) {
            return "Umum";
        } else if ($this->jenis_paket == 2) {
            return "Instansi";
        } else if ($this->jenis_paket == 3) {
            return "Umum Instansi";
        }
    }
}
