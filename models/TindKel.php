<?php

namespace app\models;

use app\components\Helper;
use Yii;
use yii\web\Response;

/**
 * This is the model class for table "dbo.TindKel".
 *
 * @property string|null $KELOMPOK
 * @property string|null $TINDAKAN
 * @property string $KDKEL
 * @property string $KODE1
 * @property string $KODE2
 * @property int $lPilih
 * @property int $lHeader
 * @property int $lManual
 * @property string|null $FileReport
 * @property string|null $Jenis
 * @property float $Pajak
 * @property float $Cyto
 * @property int $lJumlah
 * @property int $lCytoHarga_Bhn
 * @property int $lCytoJs_RS
 * @property int $lCytoJs_MedL
 * @property int $lCytoJs_MedTL
 * @property float $CytoHarga_Bhn
 * @property float $CytoJs_RS
 * @property float $CytoJs_MedL
 * @property float $CytoJs_MedTL
 * @property int $lReg
 * @property int $lDrSpesialis
 * @property string|null $KodeKelDokter
 * @property int $lNonAktif
 * @property string|null $KodeKelPely
 * @property string|null $KodeKelPenerima_Rem
 * @property string|null $Parent
 * @property string|null $KodeRL_1_4
 * @property string|null $KodeRL_1_5
 * @property string|null $KodeRL_1_6
 * @property string|null $KodeRL_1_7
 * @property string|null $KodeRL_1_8
 * @property string|null $KodeRL_1_9A
 * @property string|null $KodeRL_1_9B
 * @property string|null $KodeRL_1_9C
 * @property string|null $KodeRL_1_9D
 * @property string|null $KodeRL_1_10
 * @property string|null $KodeRL_1_11A
 * @property string|null $KodeRL_1_11B
 * @property string|null $KodeRL_1_11C
 * @property string|null $KodeRL_1_13
 * @property string|null $KodeRL_1_14
 * @property string|null $KodeRL_1_15
 * @property string|null $KodeRL_1_16
 * @property string|null $KodeRL_1_20A
 * @property string|null $KodeRL_1_20B
 * @property string|null $KodeRL_1_20C
 * @property string|null $KodeRL_1_20D
 * @property string|null $KodeRL_1_5_Kat
 * @property string|null $KodeRL_1_11A_Kat
 * @property string|null $KodeRL_1_11B_Kat
 */
class TindKel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $datatk;
    public static function tableName()
    {
        return 'dbo.TindKel';
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
            [['KDKEL', 'KODE1', 'KODE2'], 'required'],
            [['lPilih', 'lHeader', 'lManual', 'lJumlah', 'lCytoHarga_Bhn', 'lCytoJs_RS', 'lCytoJs_MedL', 'lCytoJs_MedTL', 'lReg', 'lDrSpesialis', 'lNonAktif'], 'integer'],
            [['Pajak', 'Cyto', 'CytoHarga_Bhn', 'CytoJs_RS', 'CytoJs_MedL', 'CytoJs_MedTL'], 'number'],
            [['KELOMPOK'], 'string', 'max' => 255],
            [['TINDAKAN'], 'string', 'max' => 500],
            [['KDKEL', 'KODE1', 'KODE2', 'KodeKelDokter', 'KodeRL_1_5_Kat', 'KodeRL_1_11A_Kat', 'KodeRL_1_11B_Kat'], 'string', 'max' => 2],
            [['FileReport'], 'string', 'max' => 50],
            [['Jenis'], 'string', 'max' => 1],
            [['KodeKelPely', 'KodeKelPenerima_Rem'], 'string', 'max' => 4],
            [['Parent', 'KodeRL_1_4', 'KodeRL_1_5', 'KodeRL_1_6', 'KodeRL_1_7', 'KodeRL_1_8', 'KodeRL_1_9A', 'KodeRL_1_9B', 'KodeRL_1_9C', 'KodeRL_1_9D', 'KodeRL_1_10', 'KodeRL_1_11A', 'KodeRL_1_11B', 'KodeRL_1_11C', 'KodeRL_1_13', 'KodeRL_1_14', 'KodeRL_1_15', 'KodeRL_1_16', 'KodeRL_1_20A', 'KodeRL_1_20B', 'KodeRL_1_20C', 'KodeRL_1_20D'], 'string', 'max' => 6],
            [['KDKEL', 'KODE1', 'KODE2'], 'unique', 'targetAttribute' => ['KDKEL', 'KODE1', 'KODE2']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KELOMPOK' => 'Kelompok',
            'TINDAKAN' => 'Tindakan',
            'KDKEL' => 'Kdkel',
            'KODE1' => 'Kode1',
            'KODE2' => 'Kode2',
            'lPilih' => 'L Pilih',
            'lHeader' => 'L Header',
            'lManual' => 'L Manual',
            'FileReport' => 'File Report',
            'Jenis' => 'Jenis',
            'Pajak' => 'Pajak',
            'Cyto' => 'Cyto',
            'lJumlah' => 'L Jumlah',
            'lCytoHarga_Bhn' => 'L Cyto Harga Bhn',
            'lCytoJs_RS' => 'L Cyto Js Rs',
            'lCytoJs_MedL' => 'L Cyto Js Med L',
            'lCytoJs_MedTL' => 'L Cyto Js Med Tl',
            'CytoHarga_Bhn' => 'Cyto Harga Bhn',
            'CytoJs_RS' => 'Cyto Js Rs',
            'CytoJs_MedL' => 'Cyto Js Med L',
            'CytoJs_MedTL' => 'Cyto Js Med Tl',
            'lReg' => 'L Reg',
            'lDrSpesialis' => 'L Dr Spesialis',
            'KodeKelDokter' => 'Kode Kel Dokter',
            'lNonAktif' => 'L Non Aktif',
            'KodeKelPely' => 'Kode Kel Pely',
            'KodeKelPenerima_Rem' => 'Kode Kel Penerima Rem',
            'Parent' => 'Parent',
            'KodeRL_1_4' => 'Kode Rl 1 4',
            'KodeRL_1_5' => 'Kode Rl 1 5',
            'KodeRL_1_6' => 'Kode Rl 1 6',
            'KodeRL_1_7' => 'Kode Rl 1 7',
            'KodeRL_1_8' => 'Kode Rl 1 8',
            'KodeRL_1_9A' => 'Kode Rl 1 9 A',
            'KodeRL_1_9B' => 'Kode Rl 1 9 B',
            'KodeRL_1_9C' => 'Kode Rl 1 9 C',
            'KodeRL_1_9D' => 'Kode Rl 1 9 D',
            'KodeRL_1_10' => 'Kode Rl 1 10',
            'KodeRL_1_11A' => 'Kode Rl 1 11 A',
            'KodeRL_1_11B' => 'Kode Rl 1 11 B',
            'KodeRL_1_11C' => 'Kode Rl 1 11 C',
            'KodeRL_1_13' => 'Kode Rl 1 13',
            'KodeRL_1_14' => 'Kode Rl 1 14',
            'KodeRL_1_15' => 'Kode Rl 1 15',
            'KodeRL_1_16' => 'Kode Rl 1 16',
            'KodeRL_1_20A' => 'Kode Rl 1 20 A',
            'KodeRL_1_20B' => 'Kode Rl 1 20 B',
            'KodeRL_1_20C' => 'Kode Rl 1 20 C',
            'KodeRL_1_20D' => 'Kode Rl 1 20 D',
            'KodeRL_1_5_Kat' => 'Kode Rl 1 5 Kat',
            'KodeRL_1_11A_Kat' => 'Kode Rl 1 11 A Kat',
            'KodeRL_1_11B_Kat' => 'Kode Rl 1 11 B Kat',
        ];
    }

    // public static function getTindKel()
    // {
    //     $data = \Yii::$app->db->createCommand("
    //     SELECT
    //         KDKEL, KODE1, KELOMPOK, TINDAKAN
    //     FROM
    //         (SELECT
    //             KDKEL, KODE1, KELOMPOK, TINDAKAN, ROW_NUMBER() over (PARTITION BY KDKEL
    //         ORDER BY
    //             KODE1 desc)as MAX_ID
    //             FROM
    //             ". TindKel::tableName() ." tk ) as x
    //     WHERE
    //     MAX_ID = 1")->queryAll();

    //     return $data;
    // }

    public static function getTinkel() {
        $data = TindKel::find()->select(['KDKEL'])->where(['lNonAktif'=> 0])->groupBy(['KDKEL'])->asArray()->orderBy(['KDKEL'=> SORT_ASC])->all();
        //$value = (count($data) == 0) ? ['' => ''] : $data;
        $value = [];
        foreach ($data as $s) {

            $d = [
                'id' => $s['KDKEL'],
                'name' => Helper::getTindKel($s['KDKEL'])
            ];
            array_push($value, $d);
        }

        return $value;
    }

    public static function getKodeJenis() {
        $data = \Yii::$app->dbSimrsOld->createCommand("
            SELECT KDKEL + KODE1 + KODE2 as kode_jenis, KELOMPOK, TINDAKAN FROM ".TindKel::tableName()." WHERE lNonAktif=0
        ")->queryAll();
        //$value = (count($data) == 0) ? ['' => ''] : $data;
        // echo "<pre>";
        // print_r($data);
        // die;

        $value = [];
        foreach ($data as $s) {

            $d = [
                'id' => $s['kode_jenis'],
                'name' => $s['KELOMPOK']." - ".$s['TINDAKAN'],
            ];
            array_push($value, $d);
        }

        return $value;
    }
}
