<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran.kelompok_unit_layanan".
 *
 * @property int $id
 * @property int $unit_id fk ke pegawaqi.dm_unit_penepatan
 * @property int $type 1=> IGD; 2=> RJ REGULER;3=>RJ UTAMA;4=>RAWATINAP;5=>PENUNJANG
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class PendaftaranKelompokUnitLayanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran.kelompok_unit_layanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'type'], 'required'],
            [['unit_id', 'type', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['unit_id', 'type', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_id' => 'Unit',
            'type' => 'Type',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getUnit()
    {
        return $this->hasOne(PegawaiUnitPenempatan::className(), ['kode' => 'unit_id']);
    }

     function beforeSave($model)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->created_by = Yii::$app->user->identity->id;
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($model);
    }
}
