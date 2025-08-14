<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bpjskes.mapping_poli_new".
 *
 * @property int $id
 * @property string|null $bpjs_kode
 * @property string|null $bpjs_nama
 * @property string|null $bpjs_sub_kode
 * @property string|null $bpjs_sub_nama
 * @property string|null $simrs_kode
 */
class BpjskesMappingPoliNew extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bpjskes.mapping_poli_new';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bpjs_kode','bpjs_sub_kode','bpjs_sub_nama'], 'required'],
            [['bpjs_sub_nama'], 'string'],
            [['bpjs_kode', 'bpjs_sub_kode', 'simrs_kode'], 'string', 'max' => 10],
            [['bpjs_nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bpjs_kode' => 'Kode BPJS',
            'bpjs_nama' => 'Nama BPJS',
            'bpjs_sub_kode' => 'Sub Kode BPJS',
            'bpjs_sub_nama' => 'Sub Nama BPJS',
            'simrs_kode' => 'Simrs Kode',
        ];
    }

    public function getUnitPenempatan()
    {        
        return $this->hasOne(PegawaiUnitPenempatan::className(), ['kode' => 'simrs_kode']);
    }

   
}
