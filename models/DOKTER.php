<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dbo.Dokter".
 *
 * @property string $KODE
 * @property string|null $Gelar_Depan
 * @property string $NAMA
 * @property string|null $Gelar_Belakang
 * @property string|null $NIP
 * @property string|null $ALAMAT
 * @property string|null $KOTA
 * @property string|null $PHONE
 * @property string|null $SPEC
 * @property string|null $BANK
 * @property string|null $NO_AC
 * @property string|null $NAMA_AC
 * @property float $MARGIN
 * @property float $PROSHONOR
 * @property int|null $LDOKTER
 * @property string|null $KD_UPF
 * @property string|null $KD_KEL
 * @property int $lSpesialis
 * @property string|null $Modify_Date
 * @property string|null $Modify_Id
 * @property string|null $Delete_Date
 * @property string|null $Delete_ID
 * @property string|null $Delete_PC
 * @property string|null $Create_Date
 * @property string|null $Create_ID
 * @property int $LNonAktif
 * @property float $JS_RS
 * @property float $JS_MEDL
 * @property float $JS_MEDTL
 */
class DOKTER extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dbo.DOKTER';
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
            [['KODE', 'NAMA'], 'required'],
            [['MARGIN', 'PROSHONOR', 'JS_RS', 'JS_MEDL', 'JS_MEDTL'], 'number'],
            [['LDOKTER', 'lSpesialis', 'LNonAktif'], 'integer'],
            [['Modify_Date', 'Delete_Date', 'Create_Date'], 'safe'],
            [['KODE'], 'string', 'max' => 4],
            [['Gelar_Depan'], 'string', 'max' => 10],
            [['NAMA'], 'string', 'max' => 80],
            [['Gelar_Belakang', 'SPEC', 'NO_AC', 'NAMA_AC'], 'string', 'max' => 20],
            [['NIP'], 'string', 'max' => 12],
            [['ALAMAT', 'Delete_PC'], 'string', 'max' => 50],
            [['KOTA', 'PHONE'], 'string', 'max' => 30],
            [['BANK'], 'string', 'max' => 15],
            [['KD_UPF', 'KD_KEL'], 'string', 'max' => 2],
            [['Modify_Id', 'Delete_ID', 'Create_ID'], 'string', 'max' => 3],
            [['KODE'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KODE' => 'Kode',
            'Gelar_Depan' => 'Gelar Depan',
            'NAMA' => 'Nama',
            'Gelar_Belakang' => 'Gelar Belakang',
            'NIP' => 'Nip',
            'ALAMAT' => 'Alamat',
            'KOTA' => 'Kota',
            'PHONE' => 'Phone',
            'SPEC' => 'Spec',
            'BANK' => 'Bank',
            'NO_AC' => 'No Ac',
            'NAMA_AC' => 'Nama Ac',
            'MARGIN' => 'Margin',
            'PROSHONOR' => 'Proshonor',
            'LDOKTER' => 'Ldokter',
            'KD_UPF' => 'Kd Upf',
            'KD_KEL' => 'Kd Kel',
            'lSpesialis' => 'L Spesialis',
            'Modify_Date' => 'Modify Date',
            'Modify_Id' => 'Modify ID',
            'Delete_Date' => 'Delete Date',
            'Delete_ID' => 'Delete ID',
            'Delete_PC' => 'Delete Pc',
            'Create_Date' => 'Create Date',
            'Create_ID' => 'Create ID',
            'LNonAktif' => 'L Non Aktif',
            'JS_RS' => 'Js Rs',
            'JS_MEDL' => 'Js Medl',
            'JS_MEDTL' => 'Js Medtl',
        ];
    }
}
