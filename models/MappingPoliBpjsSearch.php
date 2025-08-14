<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MappingPoliBpjs;

/**
 * MappingPoliBpjsSearch represents the model behind the search form of `app\models\MappingPoliBpjs`.
 */
class MappingPoliBpjsSearch extends MappingPoliBpjs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'simrs_kode'], 'integer'],
            [['bpjs_kode', 'bpjs_nama', 'bpjs_sub_kode', 'bpjs_sub_nama'], 'safe'],
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
        $query = MappingPoliBpjs::find()->orderBy(['id'=> SORT_DESC]);

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
            'simrs_kode' => $this->simrs_kode,
        ]);

        $query->andFilterWhere(['ilike', 'bpjs_kode', $this->bpjs_kode])
            ->andFilterWhere(['ilike', 'bpjs_nama', $this->bpjs_nama])
            ->andFilterWhere(['ilike', 'bpjs_sub_kode', $this->bpjs_sub_kode])
            ->andFilterWhere(['ilike', 'bpjs_sub_nama', $this->bpjs_sub_nama]);

        return $dataProvider;
    }
}
