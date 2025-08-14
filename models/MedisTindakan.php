<?php

namespace app\models;

use Yii;
use app\models\MedisSkTarif;
use yii\helpers\ArrayHelper;
use app\models\MedisTarifTindakan;
use yii\validators\UniqueValidator;
use app\models\PendaftaranKelasRawat;
/**
 * This is the model class for table "medis.tindakan".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $deskripsi
 * @property int|null $aktif
 * @property string|null $kode_jenis
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class MedisTindakan extends \yii\db\ActiveRecord
{
    public $importFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.tindakan';
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
            [['kode_jenis'], 'unique', 'message' => '{attribute} sudah dipakai!'],
            [['deskripsi','parent_id','deskripsi','kode_jenis'], 'required'],
            [['deskripsi'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['kode_jenis'], 'string', 'max' => 255],
        ];
    }

    
   

    


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'parent_id' => 'Parent',
            'deskripsi' => 'Deskripsi',
            'aktif'     => 'Aktif',
            'kode_jenis' => 'Kode Jenis',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
            'importFile' => 'Import File',
        ];
    }

    // public function getTindakan(){
    //     return $this->hasOne(MedisTindakan::className(), ['id' => 'parent_id']);
    // }

    public function getTarifTindakan()
    {
        return $this->hasMany(MedisTarifTindakan::className(), ['tindakan_id' => 'id']);
    }

    static function getMedisTindakan($id)
    {
        return $medisTindakan  = MedisTindakan::find()->where(['id' => $id])->one();
    }

    static function getIdParentTindakan($id)
    {
        return $medisTindakan  = MedisTindakan::find()->where(['id' => $id])->one();
    }
    static function getParentTindakan($id)
    {
        return $medisTindakan  = MedisTindakan::find()->where(['id' => $id])->one();
    }

    static function getTarifTindakanMedis($id)
    {
        $tarifTindakanMedis = MedisTarifTindakan::find()
                                                ->where(['tindakan_id' => $id])
                                                ->joinWith(['medisTindakan','kelasrawat','sktarif'])
                                                ->all();

        $tarifTindakanMedis = ArrayHelper::map($tarifTindakanMedis,'id',function ($row){
            return $row;
        });
        
        return $tarifTindakanMedis;
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

    public function getParentId()
    {
        $parentsId = MedisTindakan::find()
                        ->where(['parent_id' => null])
                        ->all();                        
        $parentsId = ArrayHelper::map($parentsId,'id','deskripsi');
        
        return $parentsId;

    }

    static function getSkTarifTindakan()
    {
        $skTarifTindakan = MedisSkTarif::find()
                                        ->where(['aktif' => 1])
                                        ->all();
        $skTarifTindakan = ArrayHelper::map($skTarifTindakan,'id','nomor');

        return $skTarifTindakan;
    }

    static function getKelasRawat()
    {
        $kelasRawat = PendaftaranKelasRawat::find()
                                            ->where(['aktif' => 1])
                                            ->all();
        $kelasRawat = ArrayHelper::map($kelasRawat,'kode','nama');

        return $kelasRawat;
    }





    static function getTindakan()
    {
        $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_tindakan AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM " . MedisTindakan::tableName() . " as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
                   rec_tindakan.rumpun || ' -> ' || b.deskripsi
            FROM " . MedisTindakan::tableName() . " as b
               JOIN rec_tindakan ON b.parent_id = rec_tindakan.id
      )
      SELECT * FROM rec_tindakan ORDER BY id ASC")->queryAll();

        return $data;
    }

    static function getTindakanInduk()
    {
        $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_tindakan AS (
            SELECT a.id, a.parent_id, a.deskripsi,
                   a.deskripsi AS rumpun
            FROM " . MedisTindakan::tableName() . " as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi,
                   rec_tindakan.rumpun || ' -> ' || b.deskripsi
            FROM " . MedisTindakan::tableName() . " as b
               JOIN rec_tindakan ON b.parent_id = rec_tindakan.id
      )
      SELECT * FROM rec_tindakan WHERE id IN(select c.parent_id FROM " . MedisTindakan::tableName() . " as c where c.parent_id is not null group by c.parent_id) ORDER BY id ASC")->queryAll();

        return $data;
    }

    static function getTindakanAnak()
    {
        $data = \Yii::$app->db->createCommand("
        WITH RECURSIVE rec_tindakan AS (
            SELECT a.id, a.parent_id, a.deskripsi, a.kode_jenis,
                   a.deskripsi AS rumpun
            FROM " . MedisTindakan::tableName() . " as a
            WHERE a.parent_id IS NULL
         UNION ALL
            SELECT b.id, b.parent_id, b.deskripsi, b.kode_jenis,
                   rec_tindakan.rumpun || ' -> ' || b.deskripsi
            FROM " . MedisTindakan::tableName() . " as b
               JOIN rec_tindakan ON b.parent_id = rec_tindakan.id
      )
      SELECT * FROM rec_tindakan WHERE id NOT IN(select c.parent_id FROM " . MedisTindakan::tableName() . " as c where c.parent_id is not null group by c.parent_id) AND parent_id is not null ORDER BY id ASC")->queryAll();

        return $data;
    }
}
