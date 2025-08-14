<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai.dm_unit_sub_penempatan".
 *
 * @property int $kode
 * @property string|null $nama
 * @property int|null $kode_rumpun
 * @property int|null $kode_group 1=Direktorat 
 2=Bagian/Bidang 
 3=Sub Bagian/Sub Bidang/Instalasi 
 4=Unit/Ruangan
 * @property int|null $aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted
 */
class PegawaiUnitSubPenempatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.dm_unit_sub_penempatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama','kode_group','kode_rumpun'], 'required'],
            [['nama', 'created_by', 'updated_by'], 'string'],
            [['kode_rumpun', 'kode_group', 'aktif', 'is_deleted'], 'default', 'value' => null],
            [['kode_rumpun', 'kode_group', 'aktif', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama jabatan / Penempatan',
            'kode_rumpun' => 'Rumpun Jabatan',
            'kode_group' => 'Unit / Group',
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
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($model);
    }
}
