<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pegawai.dm_kabupaten".
 *
 * @property string $kode_prov_kabupaten
 * @property string|null $nama
 * @property string|null $jenis
 * @property int|null $kode_prov
 * @property int|null $aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.dm_kabupaten';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_prov_kabupaten','nama','jenis','kode_prov'], 'required'],
            [['kode_prov', 'aktif', 'is_deleted'], 'default', 'value' => null],
            [['kode_prov', 'aktif', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            // [['created_by', 'updated_by'], 'string'],
            [['kode_prov_kabupaten', 'jenis'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 50],
            [['kode_prov_kabupaten'], 'unique'],
            [['kode_prov'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['kode_prov' => 'kode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_prov_kabupaten' => 'Kode Prov Kabupaten',
            'nama' => 'Nama',
            'jenis' => 'Jenis',
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

    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(),['kode'=>'kode_prov']);
    }

    public static function getProvincies()
    {
        $provinsi = Provinsi::find()->all();
        $provinsi = ArrayHelper::map($provinsi,'kode','nama');

        return $provinsi;
    }

    public static function getKabupaten($id)
    {
        $kabs = Kabupaten::find()
                        ->where(['kode_prov' => $id])
                        ->andWhere(['is_deleted' => null])
                        ->all();
        return $kabs;
    }

    public function getKecamatan()
    {
        return $this->hasMany(Kecamatan::className(), ['kode_prov_kab_kecamatan' => 'kode_prov_kabupaten']);
    }
}
