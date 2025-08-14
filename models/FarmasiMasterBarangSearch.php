<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FarmasiMasterBarang;

/**
 * FarmasiMasterBarangSearch represents the model behind the search form of `app\models\FarmasiMasterBarang`.
 */
class FarmasiMasterBarangSearch extends FarmasiMasterBarang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang', 'created_by', 'updated_by', 'deleted_by', 'id_satuan', 'id_kemasan', 'id_kelompok', 'id_jenis', 'id_sub_jenis', 'id_golongan', 'id_klasifikasi', 'isi_per_kemasan'], 'integer'],
            [['is_active', 'is_deleted', 'is_ppn'], 'boolean'],
            [['created_at', 'updated_at', 'deleted_at', 'riwayat', 'kode_barang', 'nama_barang', 'nama_generik', 'tipe_barang', 'retriksi', 'deskripsi', 'keterangan'], 'safe'],
            [['harga_kemasan', 'harga_satuan_terakhir', 'harga_satuan_tertinggi', 'total_ppn', 'diskon_persen', 'stok_max', 'stok_min'], 'number'],
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
        $query = FarmasiMasterBarang::find();

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
            'id_barang' => $this->id_barang,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'id_satuan' => $this->id_satuan,
            'id_kemasan' => $this->id_kemasan,
            'id_kelompok' => $this->id_kelompok,
            'id_jenis' => $this->id_jenis,
            'id_sub_jenis' => $this->id_sub_jenis,
            'id_golongan' => $this->id_golongan,
            'id_klasifikasi' => $this->id_klasifikasi,
            'isi_per_kemasan' => $this->isi_per_kemasan,
            'harga_kemasan' => $this->harga_kemasan,
            'harga_satuan_terakhir' => $this->harga_satuan_terakhir,
            'harga_satuan_tertinggi' => $this->harga_satuan_tertinggi,
            'is_ppn' => $this->is_ppn,
            'total_ppn' => $this->total_ppn,
            'diskon_persen' => $this->diskon_persen,
            'stok_max' => $this->stok_max,
            'stok_min' => $this->stok_min,
        ]);

        $query->andFilterWhere(['ilike', 'riwayat', $this->riwayat])
            ->andFilterWhere(['ilike', 'kode_barang', $this->kode_barang])
            ->andFilterWhere(['ilike', 'nama_barang', $this->nama_barang])
            ->andFilterWhere(['ilike', 'nama_generik', $this->nama_generik])
            ->andFilterWhere(['ilike', 'tipe_barang', $this->tipe_barang])
            ->andFilterWhere(['ilike', 'retriksi', $this->retriksi])
            ->andFilterWhere(['ilike', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['ilike', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
