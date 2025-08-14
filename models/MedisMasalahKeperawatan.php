<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medis.masalah_keperawatan".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $kode
 * @property string $deskripsi
 * @property string|null $tujuan
 * @property int|null $aktif
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisMasalahKeperawatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.masalah_keperawatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['kode', 'deskripsi', 'created_by'], 'required'],
            [['deskripsi', 'tujuan'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            // [['kode'], 'string', 'max' => 255],
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
            'tujuan' => 'Tujuan',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }

    static function getMasalahKeperawatan()
    {
        $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_mslh_keperawatan AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM " . MedisMasalahKeperawatan::tableName() . " as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
            rec_mslh_keperawatan.rumpun || ' -> ' || b.deskripsi
            FROM " . MedisMasalahKeperawatan::tableName() . " as b
               JOIN rec_mslh_keperawatan ON b.parent_id = rec_mslh_keperawatan.id
      )
      SELECT * FROM rec_mslh_keperawatan")->queryAll();

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
