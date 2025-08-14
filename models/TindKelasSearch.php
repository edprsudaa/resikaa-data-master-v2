<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TindKelas;

/**
 * TindKelasSearch represents the model behind the search form about `app\models\TindKelas`.
 */
class TindKelasSearch extends TindKelas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KDKEL', 'KODE1', 'KODE2', 'KodeKelas'], 'safe'],
            [['Harga_Bhn', 'Js_RS', 'Js_MedRS', 'Js_MedL', 'Js_MedTL', 'Js_KSO'], 'number'],
            [['lPilih'], 'integer'],
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
        $query = TindKelas::find();

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
            'Harga_Bhn' => $this->Harga_Bhn,
            'Js_RS' => $this->Js_RS,
            'Js_MedRS' => $this->Js_MedRS,
            'Js_MedL' => $this->Js_MedL,
            'Js_MedTL' => $this->Js_MedTL,
            'Js_KSO' => $this->Js_KSO,
            'lPilih' => $this->lPilih,
        ]);

        $query->andFilterWhere(['like', 'KDKEL', $this->KDKEL])
            ->andFilterWhere(['like', 'KODE1', $this->KODE1])
            ->andFilterWhere(['like', 'KODE2', $this->KODE2])
            ->andFilterWhere(['like', 'KodeKelas', $this->KodeKelas]);

        return $dataProvider;
    }
}
