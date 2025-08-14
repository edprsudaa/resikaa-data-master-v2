<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai.dm_pendidikan_umum".
 *
 * @property int $kode
 * @property string|null $pendidikan_umum
 * @property string|null $kode_max_gol
 */
class PegawaiPendidikanUmum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.dm_pendidikan_umum';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pendidikan_umum'], 'string', 'max' => 50],
            [['kode_max_gol'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'pendidikan_umum' => 'Nama Pendidikan Umum',
            'kode_max_gol' => 'Kode Max Golongan',
        ];
    }
}
