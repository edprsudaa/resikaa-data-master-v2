<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran.kiriman_detail".
 *
 * @property string $kode
 * @property string $kiriman_kode
 * @property string $nama
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $aktif
 * @property int|null $deleted_by
 */
class PendaftaranKirimanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran.kiriman_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kiriman_kode', 'nama'], 'required'],
            [['created_by', 'updated_by', 'aktif', 'deleted_by'], 'default', 'value' => null],
            [['created_by', 'updated_by', 'aktif', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            // [['kode', 'kiriman_kode'], 'string', 'max' => 10],
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
            'kiriman_kode' => 'Jenis Kiriman',
            'nama' => 'Nama',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'aktif' => 'Aktif',
            'deleted_by' => 'Deleted By',
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

    public function getKiriman(){
        return $this->hasOne(PendaftaranKiriman::className(), ['kode' => 'kiriman_kode']);
    }
}
