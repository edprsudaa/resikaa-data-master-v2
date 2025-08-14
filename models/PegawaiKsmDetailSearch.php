<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PegawaiKsmDetail;

/**
 * PegawaiKsmDetailSearch represents the model behind the search form of `app\models\PegawaiKsmDetail`.
 */
class PegawaiKsmDetailSearch extends PegawaiKsmDetail
{
    /**
     * {@inheritdoc}
     */
    public $kelompok_ksm_id;
    
    public function rules()
    {
        return [
            [['id', 'pegawai_id', 'kelompok_sub_ksm_id', 'kategori_dokter_id', 'aktif', 'is_deleted'], 'integer'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_by', 'deleted_at','kelompok_ksm_id'], 'safe'],
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
        $query = PegawaiKsmDetail::find();
        $query->joinWith(['kelompokSubKsm', 'kelompokKsm']);

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

        $query->andFilterWhere(['kelompok_ksm.id' => $this->kelompok_ksm_id]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pegawai_id' => $this->pegawai_id,
            'kelompok_sub_ksm_id' => $this->kelompok_sub_ksm_id,
            'kategori_dokter_id' => $this->kategori_dokter_id,
            'pegawai_ksm_detail.aktif' => $this->aktif,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['ilike', 'created_by', $this->created_by])
            ->andFilterWhere(['ilike', 'updated_by', $this->updated_by])
            ->andFilterWhere(['ilike', 'deleted_by', $this->deleted_by]);

        $query->orderBy(['created_at' => SORT_DESC]);

        return $dataProvider;
    }
}
