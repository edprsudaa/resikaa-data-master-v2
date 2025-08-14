<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PegawaiUnitSubPenempatan;

/**
 * PegawaiUnitSubPenempatanSearch represents the model behind the search form of `app\models\PegawaiUnitSubPenempatan`.
 */
class PegawaiUnitSubPenempatanSearch extends PegawaiUnitSubPenempatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'kode_rumpun', 'kode_group', 'aktif', 'is_deleted'], 'integer'],
            [['nama', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = PegawaiUnitSubPenempatan::find()->orderBy(['kode'=> SORT_ASC]);

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
            'kode_rumpun' => $this->kode_rumpun,
            'kode_group' => $this->kode_group,
            'aktif' => $this->aktif,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by])
            ->andFilterWhere(['ilike', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
