<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "master.kelompok_sub_ksm".
 *
 * @property int $id
 * @property int $kelompok_ksm_id reff: master->kelompok ksm
 * @property string $nama
 * @property int|null $target_poin
 * @property int|null $aktif 1 = aktif, 0 = non aktif
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted 0 = no delete, 1 = deleted
 * @property string|null $deleted_by
 * @property string|null $deleted_at
 */
class KelompokSubKsm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master.kelompok_sub_ksm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kelompok_ksm_id', 'nama','target_poin'], 'required'],
            [['kelompok_ksm_id', 'target_poin', 'aktif', 'is_deleted'], 'default', 'value' => null],
            [['kelompok_ksm_id', 'target_poin', 'aktif', 'is_deleted'], 'integer'],
            [['nama', 'created_by', 'updated_by', 'deleted_by'], 'string'],
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
            'kelompok_ksm_id' => 'Kelompok KSM',
            'nama' => 'Nama',
            'target_poin' => 'Target Poin',
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

    public function getKelompokKsm()
    {
        return $this->hasOne(KelompokKsm::class, ['id' => 'kelompok_ksm_id']);
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

    public static function getListByKsm($ksm_id)
    {
        return self::find()
            ->select(['nama', 'id'])
            ->where([
                'kelompok_ksm_id' => $ksm_id,
                'aktif' => 1
            ])
            ->indexBy('id')
            ->column();
    }

}
