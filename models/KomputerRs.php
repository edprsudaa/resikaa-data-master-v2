<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sso.akses_unit".
 *
 * @property int $id
 * @property int $unit_id
 * @property int $pengguna_id
 * @property int|null $id_aplikasi
 * @property string $tanggal_aktif
 * @property string|null $tanggal_nonaktif
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 */
class KomputerRs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master.komputer_rs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_unit', 'ip_address', 'mac_address', 'nama_ruangan'], 'required'],
            [['keterangan', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_unit' => 'Kode Unit',
            'ip_address' => 'IP Address',
            'mac_address' => 'Mac Address',
            'nama_ruangan' => 'Nama Ruangan',
            'keterangan' => 'Keterangan',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
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

     public function getUnitPenempatan()
    {
        return $this->hasOne(PegawaiUnitPenempatan::className(),['kode'=>'nama_ruangan']);
    }



}
