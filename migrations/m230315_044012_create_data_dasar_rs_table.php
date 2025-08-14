<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%data_dasar_rs}}`.
 */
class m230315_044012_create_data_dasar_rs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%data_dasar_rs}}', [
            'id' => $this->primaryKey(),
            'nomor_kode_rs'     => $this->string()->notNull()->comment('Kode Rumah Sakit'),
            'tanggal_registrasi'    => $this->date(),
            'nama_rs'     => $this->string(),
            'jenis_rs'     => $this->string(),
            'kelas_rs'     => $this->string(),
            'nama_direktur_rs'     => $this->string(),
            'nama_penyelenggara_swasta'     => $this->string(),
            'alamat_rs'     => $this->text(),
            'kab_kota_rs'     => $this->string(),
            'kode_pos_rs'     => $this->string(),
            'telepon_rs'     => $this->string(),
            'fax_rs'     => $this->string(),
            'email_rs'     => $this->string(),
            'nomor_telepon_bag_umum_rs'     => $this->string(),
            'website_rs'     => $this->string(),
            'luas_tanah_rs'     => $this->string(),
            'luas_bangunan_rs'     => $this->string(),
            'nomor_surat_izin_rs'     => $this->string(),
            'tanggal_surat_izin_rs'     => $this->string(),
            'surat_izin_rs_dikeluarkan_oleh'     => $this->string(),
            'sifat_surat_izin_rs'     => $this->string(),
            'masa_berlaku_surat_izin_rs'     => $this->string(),
            'status_penyelenggara_swasta_rs'     => $this->string(),
            'akreditasi_rs'     => $this->string(),
            'pentahapan_akreditasi_rs'     => $this->string(),
            'status_akreditasi_rs'     => $this->string(),
            'tanggal_akreditasi_rs'     => $this->date(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->string(),
            'created_by' => $this->string(),
            'is_deleted' => $this->integer()->defaultValue(0),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%data_dasar_rs}}');
    }
}
