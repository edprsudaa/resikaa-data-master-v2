<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis.icd9cm_2010".
 *
 * @property string $kode
 * @property string $deskripsi
 * @property int|null $aktif
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisIcd9cm2010 extends \yii\db\ActiveRecord
{
    public $importFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.icd9cm_2010';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['importFile'], 'required', 'on' => 'importFile',
                'message' => '{attribute} Wajib Diisi!'
            ],
            [['parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['kode', 'deskripsi', 'created_by'], 'required'],
            [['deskripsi', 'keterangan'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['kode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'kode' => 'Kode',
            'deskripsi' => 'Deskripsi',
            'keterangan' => 'Keterangan',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
            'importFile' => 'Import File',
        ];
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
