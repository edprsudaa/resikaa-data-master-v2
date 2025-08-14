<?php

namespace app\models;

use Yii;
use app\models\UNIT;

/**
 * This is the model class for table "pegawai.dm_unit_penempatan".
 *
 * @property int $kode
 * @property string $nama
 * @property int $unit_rumpun
 * @property int|null $kode_unitsub_maping_simrs
 * @property int|null $aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted
 * @property int|null $is_igd
 * @property int|null $is_rj
 * @property int|null $is_ri
 * @property int|null $is_lab_pa
 * @property int|null $is_lab_pk
 * @property int|null $is_radiologi
 * @property int|null $is_ok
 * @property int|null $is_hd
 * @property int|null $is_lab_bio
 * @property int|null $is_radioterapi
 * @property int|null $is_rehab_medik
 * @property int|null $is_penunjang
 */
class PegawaiUnitPenempatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.dm_unit_penempatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'unit_rumpun'], 'required'],
            [['unit_rumpun', 'kode_unitsub_maping_simrs', 'aktif', 'is_deleted', 'is_igd', 'is_rj', 'is_ri', 'is_lab_pa', 'is_lab_pk', 'is_radiologi', 'is_ok', 'is_hd', 'is_lab_bio', 'is_radioterapi', 'is_rehab_medik', 'is_penunjang'], 'default', 'value' => null],
            [['unit_rumpun', 'kode_unitsub_maping_simrs', 'aktif', 'is_deleted', 'is_igd', 'is_rj', 'is_ri', 'is_lab_pa', 'is_lab_pk', 'is_radiologi', 'is_ok', 'is_hd', 'is_lab_bio', 'is_radioterapi', 'is_rehab_medik', 'is_penunjang'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by'], 'string'],
            [['nama'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama Unit',
            'unit_rumpun' => 'Unit Rumpun',
            'kode_unitsub_maping_simrs' => 'Kode SIMRS',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
            'is_igd' => 'IGD',
            'is_rj' => 'RJ',
            'is_ri' => 'RI',
            'is_lab_pa' => 'LAB_PA',
            'is_lab_pk' => 'LAB_PK',
            'is_radiologi' => 'RAD',
            'is_ok' => 'OK',
            'is_hd' => 'HD',
            'is_lab_bio' => 'LAB_BIO',
            'is_radioterapi' => 'RTerapi',
            'is_rehab_medik' => 'RM',
            'is_penunjang' => 'Penunjang',
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

    public function getUnitRumpun()
    {
        return $this->hasOne(PegawaiUnitPenempatan::className(),['kode'=>'unit_rumpun']);
    }

    public function getUnitMaping()
    {
        return $this->hasOne(UNIT::className(),['kode_unitsub_maping_simrs'=>'KD_INST']);
    }

    
}
