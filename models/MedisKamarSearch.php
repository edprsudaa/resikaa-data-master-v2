<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MedisKamar;

/**
 * MedisKamarSearch represents the model behind the search form of `app\models\MedisKamar`.
 */
class MedisKamarSearch extends MedisKamar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unit_id', 'aktif', 'created_by', 'updated_by', 'is_deleted','kondisi','cadangan'], 'integer'],
            [['kelas_rawat_kode', 'no_kamar', 'no_kasur', 'created_at', 'updated_at'], 'safe'],
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
        $query = MedisKamar::find()->where(['<>', 'is_deleted', 1])->orderBy(['id'=> SORT_DESC]);

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
            'unit_id' => $this->unit_id,
            'aktif' => $this->aktif,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
            'kondisi' => $this->kondisi,
            'cadangan' => $this->cadangan,
        ]);

        $query->andFilterWhere(['ilike', 'kelas_rawat_kode', $this->kelas_rawat_kode])
            ->andFilterWhere(['ilike', 'no_kamar', $this->no_kamar])
            ->andFilterWhere(['ilike', 'no_kasur', $this->no_kasur]);

        return $dataProvider;
    }
}
