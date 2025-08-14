<?php

namespace app\models;

use Yii;
use app\models\Aplikasi;
use app\models\AkunAknUser;

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
class AksesUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sso.akses_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'pengguna_id', 'tanggal_aktif', 'created_by'], 'required'],
            [['unit_id', 'id_aplikasi', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['unit_id', 'pengguna_id', 'id_aplikasi', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['tanggal_aktif', 'tanggal_nonaktif', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_id' => 'Unit',
            'pengguna_id' => 'Pengguna',
            'id_aplikasi' => 'Aplikasi',
            'tanggal_aktif' => 'Tanggal Aktif',
            'tanggal_nonaktif' => 'Tanggal Nonaktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    public function getUnitPenempatan()
    {
        return $this->hasOne(PegawaiUnitPenempatan::className(),['kode'=>'unit_id'])->select(['kode', 'nama']); 
    }

    public function getPengguna()
    {
        return $this->hasOne(AkunAknUser::className(),['userid'=>'pengguna_id'])->select(['userid','id_pegawai','nama']);
    }

    public function getAplikasi()
    {
        return $this->hasOne(Aplikasi::className(),['id' => 'id_aplikasi']);
    }

 


}
