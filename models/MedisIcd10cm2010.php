<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis.icd10cm_2010".
 *
 * @property int $id
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
class MedisIcd10cm2010 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.icd10cm_2010';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'deskripsi', 'created_by'], 'required'],
            [['deskripsi', 'keterangan'], 'string'],
            [['aktif', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
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
            'kode' => 'Kode',
            'deskripsi' => 'Deskripsi',
            'keterangan' => 'Keterangan',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }

    // static function getIcd10Cm2010()
    // {
    //     $query = "
    //     WITH RECURSIVE icd10cm2010 AS (
    //         SELECT a.id, a.parent_id, a.deskripsi, a.deskripsi AS rumpun, a.is_deleted
    //         FROM " . MedisIcd10cm2010::tableName() . " as a
    //         UNION ALL
    //         SELECT b.id, b.parent_id, b.deskripsi,
    //         icd10cm2010.rumpun || ' -> ' || b.deskripsi, b.is_deleted
    //         FROM " . MedisIcd10cm2010::tableName() . " as b
    //         JOIN icd10cm2010 ON b.parent_id = icd10cm2010.id)
    //         SELECT * FROM icd10cm2010 where is_deleted != 1 order by id ASC
    //     ";

    //     $data = \Yii::$app->db->createCommand($query)->queryAll();

    //     return $data;
    // }

    // static function getOneIcd10cm2010($id)
    // {
    //     if (empty($id)) {
    //         return $data['id'] = '';
    //     }
    //     $query = "
    //     WITH RECURSIVE icd10_cm2010 AS (
    //         SELECT a.id, a.kode, a.deskripsi, a.deskripsi AS rumpun, a.is_deleted
    //         FROM " . MedisIcd10cm2010::tableName() . " as a
    //         UNION ALL
    //         SELECT b.id, b.kode, b.deskripsi,
    //         icd10_cm2010.rumpun || ' -> ' || b.deskripsi, b.is_deleted
    //         FROM " . MedisIcd10cm2010::tableName() . " as b
    //         JOIN icd10_cm2010 ON b.kode = icd10_cm2010.kode
    //     ) SELECT * FROM icd10_cm2010 where id = $id";

    //     $data = \Yii::$app->db->createCommand($query)->queryOne();
    //     if ($data) {
    //         $data['id'] = $data['rumpun'];
    //         return $data['id'];
    //     }
    //     return $data['id'] = '';
    // }
}
