<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis2.master_tindakan".
 *
 * @property int $id_tindakan
 * @property int|null $parent_id
 * @property string $deskripsi
 * @property string|null $kode_jenis
 * @property string|null $keterangan
 * @property int $is_active
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 */
class MedisMasterTindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis2.master_tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_active', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['parent_id', 'is_active', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['deskripsi', 'created_by', 'created_at'], 'required'],
            [['deskripsi', 'keterangan'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['kode_jenis'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tindakan' => 'Id Tindakan',
            'parent_id' => 'Parent ID',
            'deskripsi' => 'Deskripsi',
            'kode_jenis' => 'Kode Jenis',
            'keterangan' => 'Keterangan',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
        ];
    }
}
