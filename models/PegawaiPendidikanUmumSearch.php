<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PegawaiPendidikanUmum;

/**
 * PegawaiPendidikanUmumSearch represents the model behind the search form of `app\models\PegawaiPendidikanUmum`.
 */
class PegawaiPendidikanUmumSearch extends PegawaiPendidikanUmum
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode'], 'integer'],
            [['pendidikan_umum', 'kode_max_gol'], 'safe'],
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
        $query = PegawaiPendidikanUmum::find();

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
            'kode' => $this->kode,
        ]);

        $query->andFilterWhere(['ilike', 'pendidikan_umum', $this->pendidikan_umum])
            ->andFilterWhere(['ilike', 'kode_max_gol', $this->kode_max_gol]);

        return $dataProvider;
    }
}
