<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis.icd10cm".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $kode
 * @property string $deskripsi
 * @property string|null $keterangan
 * @property int|null $aktif
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisIcd10cm extends \yii\db\ActiveRecord
{
    public $importFile;
    public $generasi;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.icd10cm';
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

    static function getIcd10Cm()
    {
        $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_icd10cm AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM ".MedisIcd10cm::tableName()." as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
            rec_icd10cm.rumpun || ' -> ' || b.deskripsi
            FROM ".MedisIcd10cm::tableName()." as b
               JOIN rec_icd10cm ON b.parent_id = rec_icd10cm.id
      )
      SELECT * FROM rec_icd10cm order by id ASC")->queryAll();

      return $data;
    }
}
