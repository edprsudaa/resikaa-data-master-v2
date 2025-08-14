<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran.loket_unit".
 *
 * @property int $id
 * @property string $loket_kode
 * @property int $unit_id
 * @property int $aktif
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 */
class PendaftaranLoketUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran.loket_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loket_kode', 'unit_id'], 'required'],
            [['unit_id', 'aktif', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['unit_id', 'aktif', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['loket_kode'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loket_kode' => 'Loket Kode',
            'unit_id' => 'Unit ID',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }
}
