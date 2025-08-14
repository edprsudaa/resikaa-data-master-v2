<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aplikasi;

/**
 * AplikasiSearch represents the model behind the search form of `app\models\Aplikasi`.
 */
class AplikasiSearch extends Aplikasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nma', 'inf', 'prm', 'icn', 'lnk', 'kda', 'crd', 'mdd'], 'safe'],
            [['sta'], 'boolean'],
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
        $query = Aplikasi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'sta' => $this->sta,
            'crd' => $this->crd,
            'mdd' => $this->mdd,
        ]);

        $query->andFilterWhere(['ilike', 'nma', $this->nma])
            ->andFilterWhere(['ilike', 'inf', $this->inf])
            ->andFilterWhere(['ilike', 'prm', $this->prm])
            ->andFilterWhere(['ilike', 'icn', $this->icn])
            ->andFilterWhere(['ilike', 'lnk', $this->lnk])
            ->andFilterWhere(['ilike', 'kda', $this->kda]);

        return $dataProvider;
    }
}
