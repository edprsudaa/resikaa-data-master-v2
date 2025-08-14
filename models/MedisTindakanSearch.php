<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MedisTindakan;

/**
 * MedisTindakanSearch represents the model behind the search form of `app\models\MedisTindakan`.
 */
class MedisTindakanSearch extends MedisTindakan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['deskripsi', 'kode_jenis', 'created_at', 'updated_at'], 'safe'],
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
        $query = MedisTindakan::find()        
                            ->where(['not',['parent_id' => null]])
                            ->andWhere(['or', ['is_deleted' => null], ['is_deleted' => '0']])
                            ->orderBy(['id' => SORT_ASC]);

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
            'parent_id' => $this->parent_id,
            'aktif' => $this->aktif,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['ilike', 'kode_jenis', $this->kode_jenis]);

        return $dataProvider;
    }
}
