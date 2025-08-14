<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai.dm_kecamatan".
 *
 * @property string $kode_prov_kab_kecamatan
 * @property string $nama
 * @property string|null $kode_prov_kab
 * @property string|null $kode_prov
 * @property int|null $aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.dm_kecamatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_prov_kab_kecamatan'], 'required','message' => 'Kode Kecamatan harus diisi.'],
            [['nama'], 'required','message' => 'Nama Kecamatan harus diisi.'],
            [['aktif', 'is_deleted'], 'default', 'value' => null],
            [['aktif', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['kode_prov_kab_kecamatan', 'kode_prov_kab', 'kode_prov'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 50],
            [['kode_prov_kab_kecamatan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_prov_kab_kecamatan' => 'Kode Prov Kab Kecamatan',
            'nama' => 'Nama',
            'kode_prov_kab' => 'Kabupaten',
            'kode_prov' => 'Provinsi',
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

    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(),['kode_prov_kabupaten'=>'kode_prov_kab']);
    }

    public function getKelurahan()
    {
        return $this->hasMany(Kelurahan::className(), ['kode_prov_kab_kec_kelurahan' => 'kode_prov_kab_kecamatan']);
    }

     public static function getAllKabupaten()
    {
        $kabs = Kabupaten::find()
                        ->where(['is_deleted' => null])
                        ->all();
        return $kabs;
    }

    public static function getKecamatan($id)
    {
        $kec = Kecamatan::find()
                        ->where(['kode_prov_kab' => $id])
                        ->andWhere(['is_deleted' => null])
                        ->all();
        return $kec;
    }

}
