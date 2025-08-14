<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MasterDataDasarRs;

/**
 * MasterDataDasarRsSearch represents the model behind the search form of `app\models\MasterDataDasarRs`.
 */
class MasterDataDasarRsSearch extends MasterDataDasarRs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_deleted'], 'integer'],
            [['nomor_kode_rs', 'tanggal_registrasi', 'nama_rs', 'jenis_rs', 'kelas_rs', 'nama_direktur_rs', 'nama_penyelenggara_swasta', 'alamat_rs', 'kab_kota_rs', 'kode_pos_rs', 'telepon_rs', 'fax_rs', 'email_rs', 'nomor_telepon_bag_umum_rs', 'website_rs', 'luas_tanah_rs', 'luas_bangunan_rs', 'nomor_surat_izin_rs', 'tanggal_surat_izin_rs', 'surat_izin_rs_dikeluarkan_oleh', 'sifat_surat_izin_rs', 'masa_berlaku_surat_izin_rs', 'status_penyelenggara_swasta_rs', 'akreditasi_rs', 'pentahapan_akreditasi_rs', 'status_akreditasi_rs', 'tanggal_akreditasi_rs', 'created_at', 'updated_at', 'updated_by'], 'safe'],
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
        $query = MasterDataDasarRs::find()->where(['<>', 'is_deleted', 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal_registrasi' => $this->tanggal_registrasi,
            'tanggal_akreditasi_rs' => $this->tanggal_akreditasi_rs,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'nomor_kode_rs', $this->nomor_kode_rs])
            ->andFilterWhere(['ilike', 'nama_rs', $this->nama_rs])
            ->andFilterWhere(['ilike', 'jenis_rs', $this->jenis_rs])
            ->andFilterWhere(['ilike', 'kelas_rs', $this->kelas_rs])
            ->andFilterWhere(['ilike', 'nama_direktur_rs', $this->nama_direktur_rs])
            ->andFilterWhere(['ilike', 'nama_penyelenggara_swasta', $this->nama_penyelenggara_swasta])
            ->andFilterWhere(['ilike', 'alamat_rs', $this->alamat_rs])
            ->andFilterWhere(['ilike', 'kab_kota_rs', $this->kab_kota_rs])
            ->andFilterWhere(['ilike', 'kode_pos_rs', $this->kode_pos_rs])
            ->andFilterWhere(['ilike', 'telepon_rs', $this->telepon_rs])
            ->andFilterWhere(['ilike', 'fax_rs', $this->fax_rs])
            ->andFilterWhere(['ilike', 'email_rs', $this->email_rs])
            ->andFilterWhere(['ilike', 'nomor_telepon_bag_umum_rs', $this->nomor_telepon_bag_umum_rs])
            ->andFilterWhere(['ilike', 'website_rs', $this->website_rs])
            ->andFilterWhere(['ilike', 'luas_tanah_rs', $this->luas_tanah_rs])
            ->andFilterWhere(['ilike', 'luas_bangunan_rs', $this->luas_bangunan_rs])
            ->andFilterWhere(['ilike', 'nomor_surat_izin_rs', $this->nomor_surat_izin_rs])
            ->andFilterWhere(['ilike', 'tanggal_surat_izin_rs', $this->tanggal_surat_izin_rs])
            ->andFilterWhere(['ilike', 'surat_izin_rs_dikeluarkan_oleh', $this->surat_izin_rs_dikeluarkan_oleh])
            ->andFilterWhere(['ilike', 'sifat_surat_izin_rs', $this->sifat_surat_izin_rs])
            ->andFilterWhere(['ilike', 'masa_berlaku_surat_izin_rs', $this->masa_berlaku_surat_izin_rs])
            ->andFilterWhere(['ilike', 'status_penyelenggara_swasta_rs', $this->status_penyelenggara_swasta_rs])
            ->andFilterWhere(['ilike', 'akreditasi_rs', $this->akreditasi_rs])
            ->andFilterWhere(['ilike', 'pentahapan_akreditasi_rs', $this->pentahapan_akreditasi_rs])
            ->andFilterWhere(['ilike', 'status_akreditasi_rs', $this->status_akreditasi_rs])
            ->andFilterWhere(['ilike', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
