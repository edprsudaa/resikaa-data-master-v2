<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis.intervensi_keperawatan".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $deskripsi
 * @property int|null $aktif
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisIntervensiKeperawatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.intervensi_keperawatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['deskripsi', 'created_by'], 'required'],
            [['deskripsi'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
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
            'deskripsi' => 'Deskripsi',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }

    static function getIntervensiKeperawatan()
    {
        $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_intervensi_keperawatan AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM ".MedisIntervensiKeperawatan::tableName()." as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
            rec_intervensi_keperawatan.rumpun || ' -> ' || b.deskripsi
            FROM ".MedisIntervensiKeperawatan::tableName()." as b
               JOIN rec_intervensi_keperawatan ON b.parent_id = rec_intervensi_keperawatan.id
      )
      SELECT * FROM rec_intervensi_keperawatan")->queryAll();

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
