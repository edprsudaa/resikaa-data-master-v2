<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai.dm_status_kepegawaian".
 *
 * @property int $id
 * @property string|null $status
 * @property int|null $kategori 1 = ASN,

 */
class PegawaiStatusKepegawaian extends \yii\db\ActiveRecord
{
    //  2 = NON ASN,
//  3 = OUTSOURCING
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai.dm_status_kepegawaian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kategori'], 'default', 'value' => null],
            [['kategori'], 'integer'],
            [['kategori','status'], 'required'],
            [['status'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'kategori' => 'Kategori',
        ];
    }
}
