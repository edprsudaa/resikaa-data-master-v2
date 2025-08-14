<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai.tb_hari_libur".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $keterangan
 */
class PegawaiHariLibur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.tb_hari_libur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['keterangan'], 'string', 'max' => 50],
            [['tanggal'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
        ];
    }
}
