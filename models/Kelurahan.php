<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai.dm_kelurahan_desa".
 *
 * @property string $kode_prov_kab_kec_kelurahan
 * @property string|null $nama
 * @property string|null $kode_prov_kab_kec
 * @property string|null $kode_prov_kab
 * @property string|null $kode_prov
 * @property int|null $aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted
 */
class Kelurahan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.dm_kelurahan_desa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_prov_kab_kec_kelurahan','kode_prov_kab_kec','kode_prov_kab','kode_prov','nama'], 'required'],
            [['aktif', 'is_deleted'], 'default', 'value' => null],
            [['aktif', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['kode_prov_kab_kec_kelurahan', 'kode_prov_kab_kec', 'kode_prov_kab', 'kode_prov'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 50],
            [['kode_prov_kab_kec_kelurahan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_prov_kab_kec_kelurahan' => 'Kode Prov Kab Kec Kelurahan',
            'nama' => 'Nama',
            'kode_prov_kab_kec' => 'Kode Prov Kab Kec',
            'kode_prov_kab' => 'Kode Prov Kab',
            'kode_prov' => 'Kode Prov',
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

    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(),['kode_prov_kab_kecamatan'=>'kode_prov_kab_kec']);
    }

     public static function getAllKecamatan()
    {
        $kec = Kecamatan::find()
                        ->where(['is_deleted' => null])
                        ->all();
        return $kec;
    }
}
