<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dm_jabatan".
 *
 * @property string $kode
 * @property string $nama_jabatan
 * @property int|null $kode_eselon
 * @property int $jenis_jabatan
 * @property int|null $status
 */
class Jabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        // return 'sip.dm_jabatan';
        return 'pegawai.dm_jabatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama_jabatan', 'jenis_jabatan'], 'required'],
            [['kode_eselon', 'jenis_jabatan', 'status'], 'default', 'value' => null],
            [['kode_eselon', 'jenis_jabatan', 'status'], 'integer'],
            [['kode'], 'string', 'max' => 10],
            [['nama_jabatan'], 'string', 'max' => 100],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama_jabatan' => 'Nama Jabatan',
            'kode_eselon' => 'Kode Eselon',
            'jenis_jabatan' => 'Jenis Jabatan',
            'status' => 'Status',
        ];
    }

    // public static function getOptionsbyjenis($kode_jenis_jabatan) {
    //     $data = static::find()->where(['jenis_jabatan'=>$kode_jenis_jabatan])->andwhere(['status'=> 1])->select(['kode AS id','nama_jabatan AS name'])->asArray()->all();
    //     $value = (count($data) == 0) ? ['' => ''] : $data;

    //     return $value;
    // }

    public static function getOptionsbyjenis($id)
    {
        $data = self::find()->select(['kode AS id','nama_jabatan AS name'])
            ->where(['jenis_jabatan'=>$id, 'status'=>1])->asArray()->all();

            // echo '<pre>';
            // print_r($data);
            // die();

        if(!empty($data)){
            return $data;
        }else{
            return [];
        }
    }
}
