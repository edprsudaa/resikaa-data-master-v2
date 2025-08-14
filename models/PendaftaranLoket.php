<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran.loket".
 *
 * @property string $kode
 * @property string $nama
 * @property int $aktif
 * @property int|null $is_reg
 * @property int|null $is_kasir
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 */
class PendaftaranLoket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran.loket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['aktif', 'is_reg', 'is_kasir', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['aktif', 'is_reg', 'is_kasir', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['kode'], 'string', 'max' => 2],
            [['nama'], 'string', 'max' => 100],
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
            'aktif' => 'Aktif',
            'is_reg' => 'Is Reg',
            'is_kasir' => 'Is Kasir',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }
}
