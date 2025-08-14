<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis.sk_tarif".
 *
 * @property int $id
 * @property string $nomor
 * @property string $tanggal
 * @property string|null $keterangan
 * @property int|null $aktif
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisSkTarif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.sk_tarif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor', 'tanggal', 'created_by'], 'required'],
            [['tanggal', 'created_at', 'updated_at'], 'safe'],
            [['keterangan'], 'string'],
            [['aktif', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['nomor'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor' => 'Nomor',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }

     function beforeSave($model)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->created_by = Yii::$app->user->identity->id;
            $this->is_deleted = 0;
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($model);
    }

}
