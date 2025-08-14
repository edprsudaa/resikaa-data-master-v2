<?php

namespace app\models;

use app\components\Helper;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "medis.tarif_kamar".
 *
 * @property int $id
 * @property int $kamar_id reff medis.kamar.id
 * @property int $sk_tarif_id reff medis.sk_tarif.id
 * @property int $biaya
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisTarifKamar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.tarif_kamar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kamar_id', 'sk_tarif_id', 'created_by'], 'required'],
            [['kamar_id', 'sk_tarif_id', 'biaya', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['kamar_id', 'sk_tarif_id', 'biaya', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kamar_id' => 'Nama kamar',
            'sk_tarif_id' => 'SK Tarif',
            'biaya' => 'Biaya',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }

    // public function getKelasrawat(){
    //     return $this->hasOne(PendaftaranKelasRawat::className(), ['kode' => 'kelas_rawat_kode']);
    // }

    static function DataKamar()
    {
        $dataTarif = MedisTarifKamar::find()->select('kamar_id')->where(['<>', 'is_deleted', 1])->groupBy('kamar_id')->asArray()->all();

        $array = ArrayHelper::getColumn($dataTarif, function ($element) {
            return $element['kamar_id'];
        });

        $Data = MedisKamar::find()->where(['<>', 'is_deleted', 1])->andWhere(['not in','id', $array])->orderBy(['id'=>SORT_ASC])->asArray()->all();

        

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
    
    public function getKamar(){
        return $this->hasOne(MedisKamar::className(), ['id' => 'kamar_id']);
    }

    public function getSktarif(){
        return $this->hasOne(MedisSkTarif::className(), ['id' => 'sk_tarif_id']);
    }

   
}
