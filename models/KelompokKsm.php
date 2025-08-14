<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "master.kelompok_ksm".
 *
 * @property int $id
 * @property string|null $nama
 * @property int|null $aktif 1 = aktif, 0 = non aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted 0 = no delete, 1 = deleted
 * @property string|null $deleted_by
 * @property string|null $deleted_at
 */
class KelompokKsm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master.kelompok_ksm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'created_by', 'updated_by', 'deleted_by'], 'string'],
            [['aktif', 'is_deleted'], 'default', 'value' => null],
            [['aktif', 'is_deleted'], 'integer'],
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
            'nama' => 'Nama',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
        ];
    }

    function beforeSave($model)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->created_by = Yii::$app->user->identity->id ?? null;
            $this->aktif = 1; 
            $this->is_deleted = 0; 
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->updated_by = Yii::$app->user->identity->id ?? null;
        }
        return parent::beforeSave($model);
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName().'.is_deleted' => 0]);
    }

    public static function getList($onlyActive = true)
    {
        $query = self::find()
            ->select(['id', 'nama'])
            ->orderBy(['nama' => SORT_ASC])
            ->asArray();

        if ($onlyActive) {
            $query->andWhere(['aktif' => 1]);
        }

        return ArrayHelper::map($query->all(), 'id', 'nama');
    }
}
