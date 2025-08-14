<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dbo.UNIT".
 *
 * @property string $KD_INST
 * @property string|null $KET
 * @property float|null $TAM_CYTO
 * @property string|null $KAUNIT
 * @property int $LUNIT
 * @property float $JS_RS
 * @property float $JS_MEDL
 * @property float $JS_MEDTL
 * @property float $JS_LAIN1
 * @property float $JS_LAIN2
 * @property int $LINAP
 * @property int $LPENUNJANG
 * @property int $LGEJALA
 * @property string|null $KODE_ACCD
 * @property string|null $KODE_ACCK
 * @property int $LPILIH
 * @property float $JS_RS2
 * @property float $JS_MEDL2
 * @property float $JS_MEDTL2
 * @property string|null $KODEKEL
 * @property string|null $KODEKELAS
 * @property int $LIGD
 * @property string|null $HARIBUKA
 * @property int $LNONAKTIF
 * @property string|null $KETBIAYA
 * @property string|null $KODEPELY_RL
 * @property string|null $KODEJENISTIND
 * @property string|null $KodeGrupAntrian
 * @property int $LREGPAS
 * @property int $LBiayaKonsulRJ
 * @property int $LBiayaKonsulRI
 */
class UNIT extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dbo.UNIT';
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
            [['KD_INST'], 'required'],
            [['TAM_CYTO', 'JS_RS', 'JS_MEDL', 'JS_MEDTL', 'JS_LAIN1', 'JS_LAIN2', 'JS_RS2', 'JS_MEDL2', 'JS_MEDTL2'], 'number'],
            [['LUNIT', 'LINAP', 'LPENUNJANG', 'LGEJALA', 'LPILIH', 'LIGD', 'LNONAKTIF', 'LREGPAS', 'LBiayaKonsulRJ', 'LBiayaKonsulRI'], 'integer'],
            [['KD_INST', 'KODEKEL'], 'string', 'max' => 4],
            [['KET', 'KETBIAYA'], 'string', 'max' => 50],
            [['KAUNIT', 'KODE_ACCD', 'KODE_ACCK'], 'string', 'max' => 30],
            [['KODEKELAS', 'KodeGrupAntrian'], 'string', 'max' => 2],
            [['HARIBUKA'], 'string', 'max' => 100],
            [['KODEPELY_RL'], 'string', 'max' => 6],
            [['KODEJENISTIND'], 'string', 'max' => 9],
            [['KD_INST'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KD_INST' => 'Kd Inst',
            'KET' => 'Ket',
            'TAM_CYTO' => 'Tam Cyto',
            'KAUNIT' => 'Kaunit',
            'LUNIT' => 'Lunit',
            'JS_RS' => 'Js Rs',
            'JS_MEDL' => 'Js Medl',
            'JS_MEDTL' => 'Js Medtl',
            'JS_LAIN1' => 'Js Lain1',
            'JS_LAIN2' => 'Js Lain2',
            'LINAP' => 'Linap',
            'LPENUNJANG' => 'Lpenunjang',
            'LGEJALA' => 'Lgejala',
            'KODE_ACCD' => 'Kode Accd',
            'KODE_ACCK' => 'Kode Acck',
            'LPILIH' => 'Lpilih',
            'JS_RS2' => 'Js Rs2',
            'JS_MEDL2' => 'Js Medl2',
            'JS_MEDTL2' => 'Js Medtl2',
            'KODEKEL' => 'Kodekel',
            'KODEKELAS' => 'Kodekelas',
            'LIGD' => 'Ligd',
            'HARIBUKA' => 'Haribuka',
            'LNONAKTIF' => 'Lnonaktif',
            'KETBIAYA' => 'Ketbiaya',
            'KODEPELY_RL' => 'Kodepely Rl',
            'KODEJENISTIND' => 'Kodejenistind',
            'KodeGrupAntrian' => 'Kode Grup Antrian',
            'LREGPAS' => 'Lregpas',
            'LBiayaKonsulRJ' => 'L Biaya Konsul Rj',
            'LBiayaKonsulRI' => 'L Biaya Konsul Ri',
        ];
    }
}
