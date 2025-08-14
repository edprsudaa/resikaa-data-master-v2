<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran.cara_masuk_unit".
 *
 * @property string $kode
 * @property string $nama
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $aktif
 * @property string|null $kode_lama
 */
class PendaftaranCaraMasukUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran.cara_masuk_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama', 'created_by', 'created_at'], 'required'],
            [['created_by', 'updated_by', 'deleted_by', 'aktif'], 'default', 'value' => null],
            [['created_by', 'updated_by', 'deleted_by', 'aktif'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            // [['kode_lama'], 'string'],
            // [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 255],
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
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'aktif' => 'Aktif',
            'kode_lama' => 'Kode Lama',
        ];
    }
}
