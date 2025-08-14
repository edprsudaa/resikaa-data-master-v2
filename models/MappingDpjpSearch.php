<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MappingDpjp;

/**
 * MappingDpjpSearch represents the model behind the search form of `app\models\MappingDpjp`.
 */
class MappingDpjpSearch extends MappingDpjp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'simrs_dpjp_kode'], 'integer'],
            [['bpjs_dpjp_kode', 'simrs_dpjp_kode_old','poli_kode_bpjs','sub_poli_kode_bpjs','kategori_medis'], 'safe'],
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
        $query = MappingDpjp::find()->orderBy(['id'=> SORT_DESC]);

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
            'simrs_dpjp_kode' => $this->simrs_dpjp_kode,
            'kategori_medis' => $this->kategori_medis,
        ]);

        $query->andFilterWhere(['ilike', 'bpjs_dpjp_kode', $this->bpjs_dpjp_kode])
            ->andFilterWhere(['ilike', 'simrs_dpjp_kode_old', $this->simrs_dpjp_kode_old])
            ->andFilterWhere(['ilike', 'poli_kode_bpjs', $this->poli_kode_bpjs])
            ->andFilterWhere(['ilike', 'sub_poli_kode_bpjs', $this->sub_poli_kode_bpjs]);

        return $dataProvider;
    }
}
