<?php

namespace app\models;

use Yii;
use app\models\Kabupaten;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "master.data_dasar_rs".
 *
 * @property int $id
 * @property string $nomor_kode_rs Kode Rumah Sakit
 * @property string|null $tanggal_registrasi
 * @property string|null $nama_rs
 * @property string|null $jenis_rs
 * @property string|null $kelas_rs
 * @property string|null $nama_direktur_rs
 * @property string|null $nama_penyelenggara_swasta
 * @property string|null $alamat_rs
 * @property string|null $kab_kota_rs
 * @property string|null $kode_pos_rs
 * @property string|null $telepon_rs
 * @property string|null $fax_rs
 * @property string|null $email_rs
 * @property string|null $nomor_telepon_bag_umum_rs
 * @property string|null $website_rs
 * @property string|null $luas_tanah_rs
 * @property string|null $luas_bangunan_rs
 * @property string|null $nomor_surat_izin_rs
 * @property string|null $tanggal_surat_izin_rs
 * @property string|null $surat_izin_rs_dikeluarkan_oleh
 * @property string|null $sifat_surat_izin_rs
 * @property string|null $masa_berlaku_surat_izin_rs
 * @property string|null $status_penyelenggara_swasta_rs
 * @property string|null $akreditasi_rs
 * @property string|null $pentahapan_akreditasi_rs
 * @property string|null $status_akreditasi_rs
 * @property string|null $tanggal_akreditasi_rs
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property int|null $is_deleted
 */
class MasterDataDasarRs extends \yii\db\ActiveRecord
{

    const JENIS_RUMAH_SAKIT = [
        'RSU' => 'RSU', 
        'RS JIWA' => 'RS JIWA', 
        'RS BERSALIN' => 'RS BERSALIN',
        'RS MATA' => 'RS MATA',
        'RS KANKER' => 'RS KANKER',
        'RS TUBERKULOSA PARU' => 'RS TUBERKULOSA PARU',
        'RS KUSTA' => 'RS KUSTA',
        'RS PENYAKIT INFEKSI' => 'RS PENYAKIT INFEKSI',
        'RS ORTOPEDI' => 'RS ORTOPEDI',
        'RSK PENYAKIT DALAM' => 'RSK PENYAKIT DALAM',
        'RSK BEDAH' => 'RSK BEDAH',
        'RS JANTUNG' => 'RS JANTUNG',
        'RSK THT' => 'RSK THT',
        'RS STROKE' => 'RS STROKE',
        'RS ANAK DAN BUNDA' => 'RS ANAK & BUNDA',
        'RS IBU DAN ANAK' => 'RS IBU & ANAK',
        'RSK ANAK' => 'RSK ANAK',
        'RSK SYARAF' => 'RSK SYARAF',
        'RSK GINJAL' => 'RSK GINJAL',
        'RSK GIGI DAN MULUT' => 'RSK GIGI & MULUT',
    ];

    const KELAS_RUMAH_SAKIT =[
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
        'BELUM DITETAPKAN' => 'BELUM DITETAPKAN',
    ];

    const STATUS_PENYELENGGARA_SWASTA = [
        'ISLAM'             => 'ISLAM',
        'KHATOLIK'          => 'KHATOLIK',
        'PROTESTAN'         => 'PROTESTAN',
        'HINDU'             => 'HINDU',
        'BUDHA'             => 'BUDHA',
        'ORGANISASI SOSIAL' => 'ORGANISASI SOSIAL',
        'PERUSAHAAN'        => 'PERUSAHAAN',
        'PERORANGAN'        => 'PERORANGAN',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master.data_dasar_rs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_kode_rs','nama_rs','jenis_rs','kelas_rs','nama_direktur_rs','alamat_rs','nomor_surat_izin_rs','tanggal_surat_izin_rs','akreditasi_rs'], 'required'],
            [['tanggal_registrasi', 'tanggal_akreditasi_rs', 'created_at', 'updated_at'], 'safe'],
            [['alamat_rs'], 'string'],
            [['is_deleted'], 'default', 'value' => null],
            [['is_deleted'], 'integer'],
            [['nomor_kode_rs', 'nama_rs', 'jenis_rs', 'kelas_rs', 'nama_direktur_rs', 'nama_penyelenggara_swasta', 'kab_kota_rs', 'kode_pos_rs', 'telepon_rs', 'fax_rs', 'email_rs', 'nomor_telepon_bag_umum_rs', 'website_rs', 'luas_tanah_rs', 'luas_bangunan_rs', 'nomor_surat_izin_rs', 'tanggal_surat_izin_rs', 'surat_izin_rs_dikeluarkan_oleh', 'sifat_surat_izin_rs', 'masa_berlaku_surat_izin_rs', 'status_penyelenggara_swasta_rs', 'akreditasi_rs', 'pentahapan_akreditasi_rs', 'status_akreditasi_rs', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_kode_rs' => 'Nomor Kode Rs',
            'tanggal_registrasi' => 'Tanggal Registrasi',
            'nama_rs' => 'Nama Rs',
            'jenis_rs' => 'Jenis Rs',
            'kelas_rs' => 'Kelas Rs',
            'nama_direktur_rs' => 'Nama Direktur Rs',
            'nama_penyelenggara_swasta' => 'Nama Penyelenggara Swasta',
            'alamat_rs' => 'Alamat Rs',
            'kab_kota_rs' => 'Kab Kota Rs',
            'kode_pos_rs' => 'Kode Pos Rs',
            'telepon_rs' => 'Telepon Rs',
            'fax_rs' => 'Fax Rs',
            'email_rs' => 'Email Rs',
            'nomor_telepon_bag_umum_rs' => 'Nomor Telepon Bag Umum Rs',
            'website_rs' => 'Website Rs',
            'luas_tanah_rs' => 'Luas Tanah Rs',
            'luas_bangunan_rs' => 'Luas Bangunan Rs',
            'nomor_surat_izin_rs' => 'Nomor Surat Izin Rs',
            'tanggal_surat_izin_rs' => 'Tanggal Surat Izin Rs',
            'surat_izin_rs_dikeluarkan_oleh' => 'Surat Izin Rs Dikeluarkan Oleh',
            'sifat_surat_izin_rs' => 'Sifat Surat Izin Rs',
            'masa_berlaku_surat_izin_rs' => 'Masa Berlaku Surat Izin Rs',
            'status_penyelenggara_swasta_rs' => 'Status Penyelenggara Swasta Rs',
            'akreditasi_rs' => 'Akreditasi Rs',
            'pentahapan_akreditasi_rs' => 'Pentahapan Akreditasi Rs',
            'status_akreditasi_rs' => 'Status Akreditasi Rs',
            'tanggal_akreditasi_rs' => 'Tanggal Akreditasi Rs',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }

     public static function getKabupaten()
    {
        $kabupaten = Kabupaten::find()->all();
        $kabupaten = ArrayHelper::map($kabupaten,'kode_prov_kabupaten','nama');

        return $kabupaten;
    }

    function beforeSave($model)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->is_deleted = 0;
            $this->created_by = Yii::$app->user->identity->id;
        } else {
            $this->updated_at = date('Y-m-d H:i:s');
            $this->is_deleted = 0;
            $this->updated_by = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($model);
    }
}
