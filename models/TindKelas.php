<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dbo.TindKelas".
 *
 * @property string $KDKEL
 * @property string $KODE1
 * @property string $KODE2
 * @property string $KodeKelas
 * @property float $Harga_Bhn
 * @property float $Js_RS
 * @property float $Js_MedRS
 * @property float $Js_MedL
 * @property float $Js_MedTL
 * @property float $Js_KSO
 * @property int $lPilih
 */
class TindKelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dbo.TindKelas';
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
            [['KDKEL', 'KODE1', 'KODE2', 'KodeKelas'], 'required'],
            [['Harga_Bhn', 'Js_RS', 'Js_MedRS', 'Js_MedL', 'Js_MedTL', 'Js_KSO'], 'number'],
            [['lPilih'], 'integer'],
            [['KDKEL', 'KODE1', 'KODE2', 'KodeKelas'], 'string', 'max' => 2],
            [['KDKEL', 'KODE1', 'KODE2', 'KodeKelas'], 'unique', 'targetAttribute' => ['KDKEL', 'KODE1', 'KODE2', 'KodeKelas']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KDKEL' => 'Kdkel',
            'KODE1' => 'Kode1',
            'KODE2' => 'Kode2',
            'KodeKelas' => 'Kode Kelas',
            'Harga_Bhn' => 'Harga Bhn',
            'Js_RS' => 'Js Rs',
            'Js_MedRS' => 'Js Med Rs',
            'Js_MedL' => 'Js Med L',
            'Js_MedTL' => 'Js Med Tl',
            'Js_KSO' => 'Js Kso',
            'lPilih' => 'L Pilih',
        ];
    }
}
