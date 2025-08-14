<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PegawaiJurusan;

/**
 * PegawaiJurusanSearch represents the model behind the search form of `app\models\PegawaiJurusan`.
 */
class PegawaiJurusanSearch extends PegawaiJurusan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'aktif', 'is_deleted'], 'integer'],
            [['kode_jurusan', 'nama_jurusan', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = PegawaiJurusan::find()->where(['is_deleted' => null]);
        
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
            'aktif' => $this->aktif,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'kode_jurusan', $this->kode_jurusan])
            ->andFilterWhere(['ilike', 'nama_jurusan', $this->nama_jurusan])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by])
            ->andFilterWhere(['ilike', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
