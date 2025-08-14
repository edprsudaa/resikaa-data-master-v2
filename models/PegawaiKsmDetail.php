<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master.pegawai_ksm_detail".
 *
 * @property int $id
 * @property int $pegawai_id reff: pegawai->tb_pegawai
 * @property int $kelompok_sub_ksm_id reff: master->kelompok_sub_ksm
 * @property int $kategori_dokter_id reff : master->kategori_dokter
 * @property int|null $aktif 1 = aktif, 0 = non aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted 0 = no delete, 1 = deleted
 * @property string|null $deleted_by
 * @property string|null $deleted_at
 */
class PegawaiKsmDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master.pegawai_ksm_detail';
    }

    /**
     * {@inheritdoc}
     */
    public $kelompok_ksm_id;

    public function rules()
    {
        return [
            [['pegawai_id', 'kelompok_sub_ksm_id', 'kategori_dokter_id'], 'required'],
            [['pegawai_id', 'kelompok_sub_ksm_id', 'kategori_dokter_id', 'aktif', 'is_deleted'], 'default', 'value' => null],
            [['pegawai_id', 'kelompok_sub_ksm_id', 'kategori_dokter_id', 'aktif', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at','kelompok_ksm_id'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pegawai_id' => 'Dokter',
            'kelompok_sub_ksm_id' => 'Kelompok Sub KSM',
            'kategori_dokter_id' => 'Kategori Dokter',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'kelompok_ksm_id' => 'Kelompok Ksm'
        ];
    }

    function beforeSave($model)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->created_by = Yii::$app->user->identity->id ?? null;
            $this->aktif = 1; 
            $this->is_deleted = 0; 
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->identity->id ?? null;
        }
        return parent::beforeSave($model);
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName().'.is_deleted' => 0]);
    }

    public function getKelompokSubKsm()
    {
        return $this->hasOne(KelompokSubKsm::class, ['id' => 'kelompok_sub_ksm_id']);
    }

    public function getKelompokKsm()
    {
        return $this->hasOne(KelompokKsm::class, ['id' => 'kelompok_ksm_id'])
            ->via('kelompokSubKsm');
    }

    public function getPegawai()
    {
        return $this->hasOne(TbPegawai::class, ['pegawai_id' => 'pegawai_id']);
    }

    public function getKategoriDokter()
    {
        return $this->hasOne(KategoriDokter::class, ['id' => 'kategori_dokter_id']);
    }

    public static function isPegawaiAktif($pegawaiId)
    {
        return self::find()
            ->where([
                'pegawai_id' => $pegawaiId,
                'aktif' => 1,
                'is_deleted' => 0
            ])
            ->exists();
    }
}
