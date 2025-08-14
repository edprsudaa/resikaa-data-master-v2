<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kelurahan;

/**
 * KelurahanSearch represents the model behind the search form of `app\models\Kelurahan`.
 */
class KelurahanSearch extends Kelurahan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_prov_kab_kec_kelurahan', 'nama', 'kode_prov_kab_kec', 'kode_prov_kab', 'kode_prov', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
            [['aktif', 'is_deleted'], 'integer'],
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
        $query = Kelurahan::find()
                ->where(['is_deleted' => null]);

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
            'aktif' => $this->aktif,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'kode_prov_kab_kec_kelurahan', $this->kode_prov_kab_kec_kelurahan])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'kode_prov_kab_kec', $this->kode_prov_kab_kec])
            ->andFilterWhere(['ilike', 'kode_prov_kab', $this->kode_prov_kab])
            ->andFilterWhere(['ilike', 'kode_prov', $this->kode_prov])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by])
            ->andFilterWhere(['ilike', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
