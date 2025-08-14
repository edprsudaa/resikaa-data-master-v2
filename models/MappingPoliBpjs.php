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
 * @property int|null $simrs_kode
 */
class MappingPoliBpjs extends \yii\db\ActiveRecord
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
            [['bpjs_sub_nama'], 'string'],
            [['simrs_kode'], 'default', 'value' => null],
            [['simrs_kode'], 'integer'],
            [['bpjs_kode', 'bpjs_sub_kode'], 'string', 'max' => 10],
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
            'bpjs_kode' => 'Bpjs Kode',
            'bpjs_nama' => 'Bpjs Nama',
            'bpjs_sub_kode' => 'Bpjs Sub Kode',
            'bpjs_sub_nama' => 'Bpjs Sub Nama',
            'simrs_kode' => 'Simrs Kode',
        ];
    }

    public function getUnit()
    {
        return $this->hasOne(PegawaiUnitPenempatan::class, ['kode' => 'simrs_kode']);
    }
}
