<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "medis.tarif_tindakan".
 *
 * @property int $id
 * @property int $tindakan_id
 * @property string $kelas_rawat_kode
 * @property int $sk_tarif_id
 * @property int $js_adm
 * @property int $js_sarana
 * @property int $js_bhp
 * @property int $js_dokter_operator
 * @property int $js_dokter_lainya
 * @property int $js_dokter_anastesi
 * @property int $js_penata_anastesi
 * @property int $js_paramedis
 * @property int $js_lainya
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisTarifTindakan extends \yii\db\ActiveRecord
{
    public $importFile;
    public $Referensi;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.tarif_tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['importFile'], 'required', 'on' => 'importFile',
                'message' => '{attribute} Wajib Diisi!'
            ],
            [['tindakan_id', 'kelas_rawat_kode', 'sk_tarif_id', 'created_by'], 'required'],
            [['tindakan_id', 'sk_tarif_id', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['js_adm', 'js_sarana', 'js_bhp', 'js_dokter_operator', 'js_dokter_lainya', 'js_dokter_anastesi', 'js_penata_anastesi', 'js_paramedis', 'js_lainya', 'js_adm_cto', 'js_sarana_cto', 'js_bhp_cto', 'js_dokter_operator_cto', 'js_dokter_lainya_cto', 'js_dokter_anastesi_cto', 'js_penata_anastesi_cto', 'js_paramedis_cto', 'js_lainya_cto'], 'default', 'value' => 0],
            [['tindakan_id', 'sk_tarif_id', 'created_by', 'updated_by', 'is_deleted'], 'number'],
            [['js_adm', 'js_sarana', 'js_bhp', 'js_dokter_operator', 'js_dokter_lainya', 'js_dokter_anastesi', 'js_penata_anastesi', 'js_paramedis', 'js_lainya', 'js_adm_cto', 'js_sarana_cto', 'js_bhp_cto', 'js_dokter_operator_cto', 'js_dokter_lainya_cto', 'js_dokter_anastesi_cto', 'js_penata_anastesi_cto', 'js_paramedis_cto', 'js_lainya_cto'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['kelas_rawat_kode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tindakan_id' => 'Tindakan',
            'kelas_rawat_kode' => 'Kelas Rawat',
            'sk_tarif_id' => 'SK Tarif',
            'js_adm' => 'Jasa Administrasi',
            'js_sarana' => 'Jasa Sarana',
            'js_bhp' => 'Jasa BHP',
            'js_dokter_operator' => 'Jasa Dokter Operator',
            'js_dokter_lainya' => 'Jasa Dokter Lainya',
            'js_dokter_anastesi' => 'Jasa Dokter Anastesi',
            'js_penata_anastesi' => 'Jasa Penata Anastesi',
            'js_paramedis' => 'Jasa Paramedis',
            'js_lainya' => 'Jasa Lainya',
            'js_adm_cto' => 'Jasa Administrasi CTO',
            'js_sarana_cto' => 'Jasa Sarana CTO',
            'js_bhp_cto' => 'Jasa Bhp CTO',
            'js_dokter_operator_cto' => 'Jasa Dokter Operator CTO',
            'js_dokter_lainya_cto' => 'Jasa Dokter Lainya CTO',
            'js_dokter_anastesi_cto' => 'Jasa Dokter Anastesi CTO',
            'js_penata_anastesi_cto' => 'Jasa Penata Anastesi CTO',
            'js_paramedis_cto' => 'Jasa Paramedis CTO',
            'js_lainya_cto' => 'Jasa Lainya CTO',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
            'importFile' => 'Import File',
        ];
    }

    static function getTarifTindakanMedis($id)
    {
        $tarifTindakanMedis = MedisTarifTindakan::find()
                                                ->where(['medis.tarif_tindakan.id' => $id])
                                                ->joinWith(['medisTindakan','kelasrawat','sktarif'])
                                                ->one();

        // $tarifTindakanMedis = ArrayHelper::map($tarifTindakanMedis,'id',function ($row){
        //     return $row;
        // });
        
        return $tarifTindakanMedis;
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

    

    public function getMedisTindakan(){
        return $this->hasOne(MedisTindakan::className(), ['id' => 'tindakan_id']);
    }
    public function getTindakan(){
        return $this->hasOne(MedisTindakan::className(), ['id' => 'tindakan_id']);
    }

    public function getKelasrawat(){
        return $this->hasOne(PendaftaranKelasRawat::className(), ['kode' => 'kelas_rawat_kode']);
    }

    public function getSktarif(){
        return $this->hasOne(MedisSkTarif::className(), ['id' => 'sk_tarif_id']);
    }
}
