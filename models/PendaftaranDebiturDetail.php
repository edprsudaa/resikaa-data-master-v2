<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran.debitur_detail".
 *
 * @property string $kode
 * @property string $debitur_kode
 * @property string $nama
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int $aktif
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $kode_lama kolom pembantu mapping simrs old
 */
class PendaftaranDebiturDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran.debitur_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['debitur_kode', 'nama', 'aktif'], 'required'],
            [['created_by', 'updated_by', 'aktif', 'deleted_by', 'kode_lama'], 'default', 'value' => null],
            [['created_by', 'updated_by', 'aktif', 'deleted_by', 'kode_lama'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            // [['kode', 'debitur_kode'], 'string', 'max' => 10],
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
            'debitur_kode' => 'Debitur',
            'nama' => 'Debitur Detail',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'aktif' => 'Aktif',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'kode_lama' => 'Kode Lama',
        ];
    }

    public function getDebitur(){
        return $this->hasOne(PendaftaranDebitur::className(), ['kode' => 'debitur_kode']);
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
