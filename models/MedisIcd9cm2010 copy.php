<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis.icd9cm_2010".
 *
 * @property string $kode
 * @property string $deskripsi
 * @property int|null $aktif
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisIcd9cm2010 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.icd9cm_2010';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'deskripsi'], 'required'],
            [['deskripsi'], 'string'],
            [['aktif', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['kode'], 'string', 'max' => 255],
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
            'deskripsi' => 'Deskripsi',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
