<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bpjskes.mapping_dpjp".
 *
 * @property int $id
 * @property string $bpjs_dpjp_kode
 * @property int $simrs_dpjp_kode
 * @property string|null $simrs_dpjp_kode_old
 */
class MappingDpjp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bpjskes.mapping_dpjp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bpjs_dpjp_kode', 'simrs_dpjp_kode'], 'required'],
            [['simrs_dpjp_kode'], 'default', 'value' => null],
            [['simrs_dpjp_kode','kategori_medis'], 'integer'],
            [['bpjs_dpjp_kode', 'simrs_dpjp_kode_old','poli_kode_bpjs','sub_poli_kode_bpjs'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bpjs_dpjp_kode' => 'Bpjs Dpjp Kode',
            'simrs_dpjp_kode' => 'Simrs Dpjp Kode',
            'simrs_dpjp_kode_old' => 'Simrs Dpjp Kode Old',
            'poli_kode_bpjs' => 'Poli Kode BPJS',
            'sub_poli_kode_bpjs' => 'Sub Poli Kode BPJS',
            'kategori_medis' => 'Kategori Medis',
        ];
    }

    public function getMappingPoliBpjs()
    {
        return $this->hasOne(MappingPoliBpjs::className(),['bpjs_sub_kode'=>'sub_poli_kode_bpjs']);
    }
}
