<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran.kelas_rawat".
 *
 * @property string $kode
 * @property string $nama
 * @property int $aktif
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $kode_lama
 */
class PendaftaranKelasRawat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran.kelas_rawat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'aktif', 'created_by'], 'required'],
            [['aktif', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['aktif', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            // [['kode', 'kode_lama'], 'string', 'max' => 3],
            [['nama'], 'string', 'max' => 30],
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
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'kode_lama' => 'Kode Lama',
        ];
    }

    function beforeSave($model)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->created_by = Yii::$app->user->identity->id;
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($model);
    }
}
