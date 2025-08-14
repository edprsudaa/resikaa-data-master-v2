<?php

namespace app\models;

use app\components\Helper;
use Yii;
use yii\web\Response;

/**
 * This is the model class for table "medis.kamar".
 *
 * @property int $id
 * @property int $unit_id reff pegawai.dm_unit_penepatan.kode
 * @property string $kelas_rawat_kode reff pendaftaran.kelas_rawat.kode
 * @property string $no_kamar
 * @property string $no_kasur
 * @property int|null $aktif
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisKamar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.kamar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'kelas_rawat_kode', 'no_kamar', 'no_kasur', 'created_at', 'created_by'], 'required'],
            [['unit_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['unit_id', 'aktif', 'created_by', 'updated_by', 'is_deleted','kondisi','cadangan'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['kelas_rawat_kode', 'no_kamar', 'no_kasur'], 'string', 'max' => 255],
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
            'kelas_rawat_kode' => 'Kelas Rawat',
            'no_kamar' => 'No Kamar',
            'no_kasur' => 'No Kasur',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
            'kondisi' => 'Kondisi',
            'cadangan' => 'Kategori',
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

    static function DataKamar()
    {
        $Data = MedisKamar::find()->where(['<>', 'is_deleted', 1])->asArray()->all();

        $data = [];
        foreach ($Data as $s) {

            $d = [
                'kode' => $s['id'],
                'name' => Helper::getUnitPenempatan($s['unit_id'])." / ".Helper::getKelasRawat($s['kelas_rawat_kode'])." / ".$s['no_kamar']." / ".$s['no_kasur']
            ];
            array_push($data, $d);
        }
        return $data;
    }

    public function getKelasrawat(){
        return $this->hasOne(PendaftaranKelasRawat::className(), ['kode' => 'kelas_rawat_kode']);
    }

    public function getUnit()
    {
        return $this->hasOne(PegawaiUnitPenempatan::className(), ['kode' => 'unit_id']);
    }

    public function getTarifkamar()
    {
        return $this->hasOne(MedisTarifKamar::className(), ['id' => 'tarif_kamar_id']);
    }
}
