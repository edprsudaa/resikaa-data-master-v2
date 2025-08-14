<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dbo.VW_TARIF".
 *
 * @property string|null $Kd_Inst
 * @property string|null $Kd_SubInst
 * @property string|null $Kode1
 * @property string|null $Kode2
 * @property string|null $Ket1
 * @property string $Kd_Kelas
 * @property int|null $lDokter
 * @property float $Harga_Bhn
 * @property float $Js_RS
 * @property float $Js_MedRS
 * @property float $Js_MedL
 * @property float $Js_MedTL
 * @property float $Js_KSO
 * @property string $SP_KSO
 * @property int|null $lKet
 * @property string $KdKel1
 * @property string $Kd_Upf
 * @property string $Kd_Transfer
 * @property int|null $lBHP
 * @property float $PajakDok
 * @property int|null $lStlPajak
 * @property int|null $lAktif
 * @property string $Nil_Normal
 * @property int|null $lPilih
 * @property int|null $lHeader
 * @property string|null $JenisTindakan
 * @property string $Kode3
 * @property string|null $KELOMPOK
 * @property float|null $Cyto
 * @property int|null $lCytoHarga_Bhn
 * @property int|null $lCytoJs_RS
 * @property int|null $lCytoJs_MedL
 * @property int|null $lCytoJs_MedTL
 * @property string $KodeJenis
 * @property int|null $lReg
 * @property int|null $lDrSpesialis
 * @property string|null $KodeKelDokter
 * @property string|null $INSTALASI
 * @property float|null $TAM_CYTO
 * @property string $NAMAKELAS
 * @property float|null $JUMLAH
 * @property string|null $KAUNIT
 * @property string|null $KELOMPOKUPF
 * @property string|null $JENIS
 * @property string|null $UPF
 * @property string|null $KET
 */
class DboVWTARIF extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dbo.VW_TARIF';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbSimrsOld');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Kd_Kelas', 'Harga_Bhn', 'Js_RS', 'Js_MedRS', 'Js_MedL', 'Js_MedTL', 'Js_KSO', 'SP_KSO', 'KdKel1', 'Kd_Upf', 'Kd_Transfer', 'PajakDok', 'Nil_Normal', 'Kode3', 'KodeJenis', 'NAMAKELAS'], 'required'],
            [['lDokter', 'lKet', 'lBHP', 'lStlPajak', 'lAktif', 'lPilih', 'lHeader', 'lCytoHarga_Bhn', 'lCytoJs_RS', 'lCytoJs_MedL', 'lCytoJs_MedTL', 'lReg', 'lDrSpesialis'], 'integer'],
            [['Harga_Bhn', 'Js_RS', 'Js_MedRS', 'Js_MedL', 'Js_MedTL', 'Js_KSO', 'PajakDok', 'Cyto', 'TAM_CYTO', 'JUMLAH'], 'number'],
            [['Kd_Inst', 'Kd_SubInst', 'KdKel1'], 'string', 'max' => 4],
            [['Kode1', 'Kode2', 'Kode3'], 'string', 'max' => 3],
            [['Ket1'], 'string', 'max' => 80],
            [['Kd_Kelas', 'Kd_Upf', 'KodeKelDokter'], 'string', 'max' => 2],
            [['SP_KSO'], 'string', 'max' => 1],
            [['Kd_Transfer'], 'string', 'max' => 10],
            [['Nil_Normal'], 'string', 'max' => 5],
            [['JenisTindakan'], 'string', 'max' => 70],
            [['KELOMPOK', 'INSTALASI', 'KELOMPOKUPF', 'JENIS', 'UPF'], 'string', 'max' => 50],
            [['KodeJenis'], 'string', 'max' => 9],
            [['NAMAKELAS', 'KAUNIT'], 'string', 'max' => 30],
            [['KET'], 'string', 'max' => 101],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Kd_Inst' => 'Kd Inst',
            'Kd_SubInst' => 'Kd Sub Inst',
            'Kode1' => 'Kode1',
            'Kode2' => 'Kode2',
            'Ket1' => 'Ket1',
            'Kd_Kelas' => 'Kd Kelas',
            'lDokter' => 'L Dokter',
            'Harga_Bhn' => 'Harga Bhn',
            'Js_RS' => 'Js Rs',
            'Js_MedRS' => 'Js Med Rs',
            'Js_MedL' => 'Js Med L',
            'Js_MedTL' => 'Js Med Tl',
            'Js_KSO' => 'Js Kso',
            'SP_KSO' => 'Sp Kso',
            'lKet' => 'L Ket',
            'KdKel1' => 'Kd Kel1',
            'Kd_Upf' => 'Kd Upf',
            'Kd_Transfer' => 'Kd Transfer',
            'lBHP' => 'L Bhp',
            'PajakDok' => 'Pajak Dok',
            'lStlPajak' => 'L Stl Pajak',
            'lAktif' => 'L Aktif',
            'Nil_Normal' => 'Nil Normal',
            'lPilih' => 'L Pilih',
            'lHeader' => 'L Header',
            'JenisTindakan' => 'Jenis Tindakan',
            'Kode3' => 'Kode3',
            'KELOMPOK' => 'Kelompok',
            'Cyto' => 'Cyto',
            'lCytoHarga_Bhn' => 'L Cyto Harga Bhn',
            'lCytoJs_RS' => 'L Cyto Js Rs',
            'lCytoJs_MedL' => 'L Cyto Js Med L',
            'lCytoJs_MedTL' => 'L Cyto Js Med Tl',
            'KodeJenis' => 'Kode Jenis',
            'lReg' => 'L Reg',
            'lDrSpesialis' => 'L Dr Spesialis',
            'KodeKelDokter' => 'Kode Kel Dokter',
            'INSTALASI' => 'Instalasi',
            'TAM_CYTO' => 'Tam Cyto',
            'NAMAKELAS' => 'Namakelas',
            'JUMLAH' => 'Jumlah',
            'KAUNIT' => 'Kaunit',
            'KELOMPOKUPF' => 'Kelompokupf',
            'JENIS' => 'Jenis',
            'UPF' => 'Upf',
            'KET' => 'Ket',
        ];
    }
}
