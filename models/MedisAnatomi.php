<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis2.master_anatomi".
 *
 * @property int $id_anatomi
 * @property int|null $parent_id
 * @property int $is_active
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string $nama_latin
 * @property string $nama_indonesia
 * @property int $is_lk
 * @property int $is_pr
 * @property resource $gambar_anatomi
 */
class MedisAnatomi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis2.master_anatomi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_active', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['parent_id', 'is_active', 'created_by', 'updated_by', 'deleted_by', 'is_lk', 'is_pr'], 'integer'],
            [[ 'nama_latin', 'nama_indonesia', 'gambar_anatomi'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['gambar_anatomi'], 'string'],
            // [['nama_latin', 'nama_indonesia'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_anatomi' => 'Id Anatomi',
            'parent_id' => 'Parent ID',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'nama_latin' => 'Nama Latin',
            'nama_indonesia' => 'Nama Indonesia',
            'is_lk' => 'Laki-Laki',
            'is_pr' => 'Perempuan',
            'gambar_anatomi' => 'Gambar Anatomi',
        ];
    }

    static function AnatomiAll()
    {
        $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_anatomi AS (
            SELECT a.id_anatomi, a.parent_id, a.nama_latin, a.nama_latin AS rumpun
            FROM ".MedisAnatomi::tableName()." as a
            WHERE a.parent_id IS NULL
            UNION ALL
            SELECT b.id_anatomi, b.parent_id, b.nama_latin,
            (rec_anatomi.rumpun || ' -> ' || b.nama_latin)::varchar(512)
            FROM ".MedisAnatomi::tableName()." as b
            JOIN rec_anatomi ON b.parent_id = rec_anatomi.id_anatomi
            )
            SELECT * FROM rec_anatomi ORDER BY id_anatomi ASC")->queryAll();

      return $data;
    }

    static function AnatomiInduk()
    {
        $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_anatomi AS (
            SELECT a.id_anatomi, a.parent_id, a.nama_latin,
                   a.nama_latin AS rumpun
            FROM ".MedisAnatomi::tableName()." as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id_anatomi, b.parent_id, b.nama_latin,
                   (rec_anatomi.rumpun || ' -> ' || b.nama_latin)::varchar(512)
            FROM ".MedisAnatomi::tableName()." as b
               JOIN rec_anatomi ON b.parent_id = rec_anatomi.id_anatomi
      )
      SELECT * FROM rec_anatomi WHERE id_anatomi IN(select c.parent_id FROM ".MedisAnatomi::tableName()." as c where c.parent_id is not null group by c.parent_id) ORDER BY id_anatomi ASC")->queryAll();

      return $data;
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
