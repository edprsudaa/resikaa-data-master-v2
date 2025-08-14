<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "medis.tarif_tindakan_unit".
 *
 * @property int $id
 * @property int $tarif_tindakan_id reff medis.tarif_tindakan.id
 * @property int $unit_id reff pegawai.dm_unit_penempatan.id
 * @property int $aktif
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int $is_deleted
 */
class MedisTarifTindakanUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medis.tarif_tindakan_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarif_tindakan_id', 'unit_id', 'created_by'], 'required'],
            [['tarif_tindakan_id', 'unit_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'default', 'value' => null],
            [['tarif_tindakan_id', 'unit_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
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
            'tarif_tindakan_id' => 'Tindakan',
            'unit_id' => 'Unit',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function getUnit()
    {
        return $this->hasOne(PegawaiUnitPenempatan::className(), ['kode' => 'unit_id']);
    }

    public function getTariftindakan()
    {
        return $this->hasOne(MedisTarifTindakan::className(), ['id' => 'tarif_tindakan_id'])->with(['tindakan']);
    }

    public function getTindakan()
    {
        return $this->hasOne(MedisTindakan::className(), ['id' => 'tindakan_id']);
    }


    static function getRefTindakan()
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
        SELECT * FROM rec_tindakan where id not in 
        (select c.parent_id FROM " . MedisTindakan::tableName() . " as c where c.parent_id is not null group by c.parent_id) 
        order by id asc")->queryAll();

        return $data;
    }

    static function getTindakannya()
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
      SELECT * FROM rec_tindakan where id in 
      (select b.tindakan_id FROM " . MedisTarifTindakan::tableName() . " as b group by b.tindakan_id) 
      order by id asc")->queryAll();

        return $data;
    }

    static function getTindakanMedis()
    {

        $tindakanMedis = \Yii::$app->db->createCommand("SELECT t1.*, t2.deskripsi AS parent_deskripsi
                                                        FROM " . MedisTindakan::tableName() . " t1
                                                        INNER JOIN " . MedisTindakan::tableName() . " t2 ON t1.parent_id = t2.id
                                                        WHERE t1.parent_id IS NOT NULL AND t1.id IN (
                                                            SELECT tindakan_id FROM " . MedisTarifTindakan::tableName() . " as b group by b.tindakan_id
                                                        ) ORDER BY t2.deskripsi ASC")->queryAll();


        $tindakanMedis = ArrayHelper::map($tindakanMedis, 'id', function ($row) {
            // return $row['deskripsi'];
            return $row['parent_deskripsi'] . ' -> ' . $row['deskripsi'];
        });

        return $tindakanMedis;
    }

    static function getTindakanMedisParent()
    {

        $tindakanMedis = \Yii::$app->db->createCommand("SELECT t1.*
                                                        FROM " . MedisTindakan::tableName() . " t1
                                                        WHERE t1.parent_id IS NULL AND t1.aktif = 1 ORDER BY t1.deskripsi ASC")->queryAll();


        $tindakanMedis = ArrayHelper::map($tindakanMedis, 'id', function ($row) {
            // return $row['deskripsi'];
            return  $row['deskripsi'];
        });

        return $tindakanMedis;
    }

    static function getTindakanMedisChild($idParent)
    {
        $tindakanMedis = \Yii::$app->db->createCommand("
            SELECT t1.id, t1.deskripsi
            FROM " . MedisTindakan::tableName() . " t1
            WHERE t1.parent_id IS NOT NULL AND t1.parent_id = :idParent AND t1.aktif = 1
            ORDER BY t1.deskripsi ASC
        ")->bindValue(':idParent', $idParent)->queryAll();

        $tindakanMedis = ArrayHelper::getColumn($tindakanMedis, function ($row) {
            return [
                'id' => $row['id'],
                'text' => $row['deskripsi'],
            ];
        });

        // Tambahkan item "SEMUA TINDAKAN" di awal
        array_unshift($tindakanMedis, [
            'id' => 'all',
            'text' => 'SEMUA TINDAKAN',
        ]);

        return $tindakanMedis;
    }

    static function getTarifTindakanUnit($tindakan)
    {
        $data = \Yii::$app->db->createCommand("
        SELECT a.id, b.nama as unt_nama, d.deskripsi, e.nama as kr_nama, f.nomor 
        FROM " . MedisTarifTindakanUnit::tableName() . " a 
        INNER JOIN " . PegawaiUnitPenempatan::tableName() . " b on b.kode=a.unit_id 
        INNER JOIN " . MedisTarifTindakan::tableName() . " c on c.id=a.tarif_tindakan_id 
        INNER JOIN " . MedisTindakan::tableName() . " d on d.id=c.tindakan_id 
        INNER JOIN " . PendaftaranKelasRawat::tableName() . " e on e.kode=c.kelas_rawat_kode 
        INNER JOIN " . MedisSkTarif::tableName() . " f on f.id=c.sk_tarif_id 
        WHERE c.tindakan_id=$tindakan and a.is_deleted=0 order by b.kode")->queryAll();

        return $data;
    }
    static function getTarifTindakanByUnit($tindakan, $unit)
    {
        $data = \Yii::$app->db->createCommand("
        SELECT a.id, b.nama as unt_nama, d.deskripsi, e.nama as kr_nama, f.nomor , a.unit_id
        FROM " . MedisTarifTindakanUnit::tableName() . " a 
        INNER JOIN " . PegawaiUnitPenempatan::tableName() . " b on b.kode=a.unit_id 
        INNER JOIN " . MedisTarifTindakan::tableName() . " c on c.id=a.tarif_tindakan_id 
        INNER JOIN " . MedisTindakan::tableName() . " d on d.id=c.tindakan_id 
        INNER JOIN " . PendaftaranKelasRawat::tableName() . " e on e.kode=c.kelas_rawat_kode 
        INNER JOIN " . MedisSkTarif::tableName() . " f on f.id=c.sk_tarif_id 
        WHERE  c.tindakan_id=$tindakan and a.unit_id=$unit and a.is_deleted=0 order by b.kode")->queryAll();


        return $data;
    }

    static function getTarifTindakanByUnitKelas($tindakan, $unit, $kelas)
    {
        $data = \Yii::$app->db->createCommand("
        SELECT a.id, b.nama as unt_nama, d.deskripsi, e.nama as kr_nama, a.unit_id, c.kelas_rawat_kode, e.kode
        FROM " . MedisTarifTindakanUnit::tableName() . " a 
        INNER JOIN " . PegawaiUnitPenempatan::tableName() . " b on b.kode=a.unit_id 
        INNER JOIN " . MedisTarifTindakan::tableName() . " c on c.id=a.tarif_tindakan_id 
        INNER JOIN " . MedisTindakan::tableName() . " d on d.id=c.tindakan_id 
        INNER JOIN " . PendaftaranKelasRawat::tableName() . " e on e.kode=c.kelas_rawat_kode 
        WHERE  c.tindakan_id=$tindakan and a.unit_id=$unit and e.kode='$kelas' and a.is_deleted=0 order by b.kode")->queryAll();


        return $data;
    }


    //  function beforeSave($model)
    // {
    //     if ($this->isNewRecord) {
    //         $this->created_at = date('Y-m-d H:i:s');
    //         $this->created_by = Yii::$app->user->identity->id;
    //     } else {
    //         $this->updated_at = date('Y-m-d H:i:s');
    //         $this->updated_by = Yii::$app->user->identity->id;
    //     }
    //     return parent::beforeSave($model);
    // }

}
