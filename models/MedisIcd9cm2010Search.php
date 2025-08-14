<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MedisIcd9cm2010;

/**
 * MedisIcd9cmSearch represents the model behind the search form of `app\models\MedisIcd9cm`.
 */
class MedisIcd9cm2010Search extends MedisIcd9cm2010
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['kode', 'deskripsi', 'created_at', 'updated_at'], 'safe'],
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
        $query = MedisIcd9cm2010::find()->where(['<>', 'is_deleted', 1]);

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
            // 'kode' => $this->kode,
            // 'deskripsi' => $this->deskripsi,
            'aktif' => $this->aktif,
            // 'created_at' => $this->created_at,
            // 'created_by' => $this->created_by,
            // 'updated_at' => $this->updated_at,
            // 'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'kode', $this->kode])
            ->andFilterWhere(['ilike', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}
