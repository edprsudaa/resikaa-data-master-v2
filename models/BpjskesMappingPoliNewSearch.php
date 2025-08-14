<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BpjskesMappingPoliNew;
use app\models\PegawaiUnitPenempatan;

/**
 * BpjskesMappingPoliNewSearch represents the model behind the search form of `app\models\BpjskesMappingPoliNew`.
 */
class BpjskesMappingPoliNewSearch extends BpjskesMappingPoliNew
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bpjs_kode', 'bpjs_nama', 'bpjs_sub_kode', 'bpjs_sub_nama', 'simrs_kode'], 'safe'],
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

      $query = BpjskesMappingPoliNew::find();



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

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
