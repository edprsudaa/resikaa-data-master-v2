<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\PegawaiPendidikanUmum;

/**
 * This is the model class for table "pegawai.dm_jurusan".
 *
 * @property int $kode
 * @property string $kode_jurusan
 * @property string|null $nama_jurusan
 * @property int|null $aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted
 */
class PegawaiJurusan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.dm_jurusan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'kode_jurusan'], 'required'],
            [['kode', 'aktif', 'is_deleted'], 'default', 'value' => null],
            [['kode', 'aktif', 'is_deleted'], 'integer'],
            [['kode_jurusan', 'created_by', 'updated_by'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nama_jurusan'], 'string', 'max' => 50],
            [['kode_jurusan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Jenis Pendidikan',
            'kode_jurusan' => 'Kode Jurusan',
            'nama_jurusan' => 'Nama Jurusan',
            'aktif' => 'Status',
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

    public function getJenisPendidikan()
    {
        return $this->hasOne(PegawaiPendidikanUmum::className(),['kode'=>'kode']);
    }

    public static function getAllJenisPendidikan()
    {
        $jenisPendidikan = PegawaiPendidikanUmum::find()->orderBy(['kode'=> SORT_ASC])->all();
        $jenisPendidikan = ArrayHelper::map($jenisPendidikan,'kode','pendidikan_umum');

        return $jenisPendidikan;
    }
}
