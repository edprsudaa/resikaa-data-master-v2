<?php

namespace app\models;

use yii\base\Model;
use app\models\MedisTarifKamar;
use yii\data\ActiveDataProvider;

/**
 * MedisTarifKamarSearch represents the model behind the search form of `app\models\MedisTarifKamar`.
 */
class MedisTarifKamarSearch extends MedisTarifKamar
{

      public $kamar_id; // Existing attributes
    public $selectedUnit; 
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kamar_id', 'sk_tarif_id', 'biaya', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at','selectedUnit'], 'safe'],
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
        $searchModel = new MedisTarifKamarSearch();

        $query = MedisTarifKamar::find()->alias('a')->joinWith(['kamar.unit unit'])->where(['<>', 'a.is_deleted', 1]);

      
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
            'unit.kode' => $this->selectedUnit,
            'kamar_id' => $this->kamar_id,
            'sk_tarif_id' => $this->sk_tarif_id,
            'biaya' => $this->biaya,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        return $dataProvider;
    }
}
