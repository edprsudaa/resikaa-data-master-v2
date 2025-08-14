<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\McuPaketTindakanMcu;

/**
 * McuPaketTindakanMcuSearch represents the model behind the search form about `app\models\McuPaketTindakanMcu`.
 */
class McuPaketTindakanMcuSearch extends McuPaketTindakanMcu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kode_paket', 'harga'], 'integer'],
            [['kode_tindakan', 'kode_unit', 'nama_tabel', 'nama_kolom1', 'nama_kolom2', 'nama_tindakan'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = McuPaketTindakanMcu::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'kode_paket' => $this->kode_paket,
            'harga' => $this->harga,
        ]);

        $query->andFilterWhere(['ilike', 'kode_tindakan', $this->kode_tindakan])
            ->andFilterWhere(['like', 'kode_unit', $this->kode_unit])
            ->andFilterWhere(['like', 'nama_tabel', $this->nama_tabel])
            ->andFilterWhere(['like', 'nama_kolom1', $this->nama_kolom1])
            ->andFilterWhere(['like', 'nama_kolom2', $this->nama_kolom2])
            ->andFilterWhere(['ilike', 'nama_tindakan', $this->nama_tindakan]);

        return $dataProvider;
    }
}
