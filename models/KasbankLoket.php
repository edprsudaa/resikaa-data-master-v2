<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kasbank.loket".
 *
 * @property string $kode_loket
 * @property string $nama_loket
 * @property string $lkasir
 * @property string $status
 */
class KasbankLoket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kasbank.loket_bayar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loket_pembayaran', 'lkasir', 'status','lregistrasi'], 'required'],
            // [['kode'], 'string', 'max' => 4],
            // [['loket_pembayaran'], 'string', 'max' => 255],
            // [['lkasir','lregistrasi'], 'string', 'max' => 1],
            // [['status'], 'string', 'max' => 2],
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
            'loket_pembayaran' => 'Nama Loket Pembayaran',
            'lkasir' => 'Loket Kasir',
            'lregistrasi' => 'Loket Registrasi',
            'status' => 'Status',
        ];
    }
}
