<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dbo.KELAS".
 *
 * @property string $KELAS
 * @property string $KET
 * @property string|null $KdTind
 * @property float $Js_RS
 * @property float $Js_MedL
 * @property float $Js_MedTL
 * @property string|null $JenisKelas
 * @property int $lPilih
 */
class KELAS extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dbo.KELAS';
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
            [['KELAS', 'KET'], 'required'],
            [['Js_RS', 'Js_MedL', 'Js_MedTL'], 'number'],
            [['lPilih'], 'integer'],
            [['KELAS', 'JenisKelas'], 'string', 'max' => 2],
            [['KET'], 'string', 'max' => 30],
            [['KdTind'], 'string', 'max' => 3],
            [['KELAS'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KELAS' => 'Kelas',
            'KET' => 'Ket',
            'KdTind' => 'Kd Tind',
            'Js_RS' => 'Js Rs',
            'Js_MedL' => 'Js Med L',
            'Js_MedTL' => 'Js Med Tl',
            'JenisKelas' => 'Jenis Kelas',
            'lPilih' => 'L Pilih',
        ];
    }
}
