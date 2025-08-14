<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PegawaiPegawai;

/**
 * PegawaiPegawaiSearch represents the model behind the search form of `app\models\PegawaiPegawai`.
 */
class PegawaiPegawaiSearch extends PegawaiPegawai
{
    /**
     * 
     * 
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['pegawai_id', 'agama', 'kode_pos', 'status_kepegawaian_id', 'jenis_kepegawaian_id', 'kode_pangkat_cpns', 'tinggi_keterangan_badan', 'berat_badan_keterangan_badan', 'status_aktif_pegawai', 'tipe_user', 'id_riwayat_penempatan_terakhir'], 'integer'],
            [['id_nip_nrp', 'nama_lengkap', 'gelar_sarjana_depan', 'gelar_sarjana_belakang', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'status_perkawinan', 'alamat_tempat_tinggal', 'rt_tempat_tinggal', 'rw_tempat_tinggal', 'desa_kelurahan', 'kecamatan', 'kabupaten_kota', 'provinsi', 'no_telepon_1', 'no_telepon_2', 'golongan_darah', 'npwp', 'nomor_ktp', 'nota_persetujuan_bkn_nomor_cpns', 'nota_persetujuan_bkn_tanggal_cpns', 'pejabat_yang_menetapkan_cpns', 'sk_cpns_nomor_cpns', 'sk_cpns_tanggal_cpns', 'tmt_cpns', 'pejabat_yang_menetapkan_pns', 'sk_nomor_pns', 'sk_tanggal_pns', 'kode_pangkat_pns', 'tmt_pns', 'sumpah_janji_pns', 'rambut_keterangan_badan', 'bentuk_muka_keterangan_badan', 'warna_kulit_keterangan_badan', 'ciri_ciri_khas_keterangan_badan', 'cacat_tubuh_keterangan_badan', 'kegemaran_1', 'kegemaran_2', 'kegemaran_3', 'photo', 'kode_dokter_maping_simrs', 'niptk', 'email', 'tanda_tangan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PegawaiPegawai::find()->joinWith('akunUser');

        // var_dump($query->all());


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50, // Change this value to adjust the number of rows displayed per page
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
           
            'pegawai_id' => $this->pegawai_id,
            'tanggal_lahir' => $this->tanggal_lahir,
            'agama' => $this->agama,
            'kode_pos' => $this->kode_pos,
            'status_kepegawaian_id' => $this->status_kepegawaian_id,
            'jenis_kepegawaian_id' => $this->jenis_kepegawaian_id,
            'nota_persetujuan_bkn_tanggal_cpns' => $this->nota_persetujuan_bkn_tanggal_cpns,
            'sk_cpns_tanggal_cpns' => $this->sk_cpns_tanggal_cpns,
            'kode_pangkat_cpns' => $this->kode_pangkat_cpns,
            'tmt_cpns' => $this->tmt_cpns,
            'sk_tanggal_pns' => $this->sk_tanggal_pns,
            'tmt_pns' => $this->tmt_pns,
            'tinggi_keterangan_badan' => $this->tinggi_keterangan_badan,
            'berat_badan_keterangan_badan' => $this->berat_badan_keterangan_badan,
            'status_aktif_pegawai' => $this->status_aktif_pegawai,
            'tipe_user' => $this->tipe_user,
            'id_riwayat_penempatan_terakhir' => $this->id_riwayat_penempatan_terakhir,
        ]);

        $query->andFilterWhere(['ilike', 'id_nip_nrp', $this->id_nip_nrp])
            ->andFilterWhere(['ilike', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['ilike', 'gelar_sarjana_depan', $this->gelar_sarjana_depan])
            ->andFilterWhere(['ilike', 'gelar_sarjana_belakang', $this->gelar_sarjana_belakang])
            ->andFilterWhere(['ilike', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['ilike', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['ilike', 'status_perkawinan', $this->status_perkawinan])
            ->andFilterWhere(['ilike', 'alamat_tempat_tinggal', $this->alamat_tempat_tinggal])
            ->andFilterWhere(['ilike', 'rt_tempat_tinggal', $this->rt_tempat_tinggal])
            ->andFilterWhere(['ilike', 'rw_tempat_tinggal', $this->rw_tempat_tinggal])
            ->andFilterWhere(['ilike', 'desa_kelurahan', $this->desa_kelurahan])
            ->andFilterWhere(['ilike', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['ilike', 'kabupaten_kota', $this->kabupaten_kota])
            ->andFilterWhere(['ilike', 'provinsi', $this->provinsi])
            ->andFilterWhere(['ilike', 'no_telepon_1', $this->no_telepon_1])
            ->andFilterWhere(['ilike', 'no_telepon_2', $this->no_telepon_2])
            ->andFilterWhere(['ilike', 'golongan_darah', $this->golongan_darah])
            ->andFilterWhere(['ilike', 'npwp', $this->npwp])
            ->andFilterWhere(['ilike', 'nomor_ktp', $this->nomor_ktp])
            ->andFilterWhere(['ilike', 'nota_persetujuan_bkn_nomor_cpns', $this->nota_persetujuan_bkn_nomor_cpns])
            ->andFilterWhere(['ilike', 'pejabat_yang_menetapkan_cpns', $this->pejabat_yang_menetapkan_cpns])
            ->andFilterWhere(['ilike', 'sk_cpns_nomor_cpns', $this->sk_cpns_nomor_cpns])
            ->andFilterWhere(['ilike', 'pejabat_yang_menetapkan_pns', $this->pejabat_yang_menetapkan_pns])
            ->andFilterWhere(['ilike', 'sk_nomor_pns', $this->sk_nomor_pns])
            ->andFilterWhere(['ilike', 'kode_pangkat_pns', $this->kode_pangkat_pns])
            ->andFilterWhere(['ilike', 'sumpah_janji_pns', $this->sumpah_janji_pns])
            ->andFilterWhere(['ilike', 'rambut_keterangan_badan', $this->rambut_keterangan_badan])
            ->andFilterWhere(['ilike', 'bentuk_muka_keterangan_badan', $this->bentuk_muka_keterangan_badan])
            ->andFilterWhere(['ilike', 'warna_kulit_keterangan_badan', $this->warna_kulit_keterangan_badan])
            ->andFilterWhere(['ilike', 'ciri_ciri_khas_keterangan_badan', $this->ciri_ciri_khas_keterangan_badan])
            ->andFilterWhere(['ilike', 'cacat_tubuh_keterangan_badan', $this->cacat_tubuh_keterangan_badan])
            ->andFilterWhere(['ilike', 'kegemaran_1', $this->kegemaran_1])
            ->andFilterWhere(['ilike', 'kegemaran_2', $this->kegemaran_2])
            ->andFilterWhere(['ilike', 'kegemaran_3', $this->kegemaran_3])
            ->andFilterWhere(['ilike', 'photo', $this->photo])
            ->andFilterWhere(['ilike', 'kode_dokter_maping_simrs', $this->kode_dokter_maping_simrs])
            ->andFilterWhere(['ilike', 'niptk', $this->niptk])
            ->andFilterWhere(['ilike', 'email', $this->email])
            // ->andFilterWhere(['ilike',  'akunUser.userid' , $this->userid])
            // ->andFilterWhere(['ilike', 'akunUser.userid', $this->userid])
            // ->andFilterWhere(['ilike', 'tanda_tangan', $this->tanda_tangan])
            ;

        return $dataProvider;
    }
}
