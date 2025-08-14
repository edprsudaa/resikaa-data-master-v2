<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MedisAnatomi;

/**
 * MedisAnatomiSearch represents the model behind the search form of `app\models\MedisAnatomi`.
 */
class MedisAnatomiSearch extends MedisAnatomi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_anatomi', 'parent_id', 'is_active', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at', 'nama_latin', 'nama_indonesia', 'gambar_anatomi'], 'safe'],
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
        $query = MedisAnatomi::find();

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
            'id_anatomi' => $this->id_anatomi,
            'parent_id' => $this->parent_id,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['ilike', 'nama_latin', $this->nama_latin])
            ->andFilterWhere(['ilike', 'nama_indonesia', $this->nama_indonesia])
            ->andFilterWhere(['ilike', 'gambar_anatomi', $this->gambar_anatomi]);

        return $dataProvider;
    }
}
