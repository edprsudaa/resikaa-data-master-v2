<?php

namespace app\models\emr\pendaftaran;

use Yii;
use app\models\AkunAknUser;

/**
 * This is the model class for table "master.antrol_pengiriman_mode".
 *
 * @property int $id
 * @property int $mode 1 = langsung, 2= via cron
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class AntrolPengirimanMode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master.antrol_pengiriman_mode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mode', 'updated_by'], 'default', 'value' => null],
            [['mode', 'updated_by'], 'integer'],
            [['updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mode' => 'Mode',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getPengguna()
    {
        return $this->hasOne(AkunAknUser::className(),['userid'=>'updated_by'])->select(['userid','id_pegawai','nama']);
    }
}
