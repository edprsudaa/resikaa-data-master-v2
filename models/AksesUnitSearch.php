<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AksesUnit;

/**
 * AksesUnitSearch represents the model behind the search form of `app\models\AksesUnit`.
 */
class AksesUnitSearch extends AksesUnit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unit_id', 'pengguna_id', 'id_aplikasi', 'created_by', 'updated_by', 'deleted_by','aktif'], 'integer'],
            [['tanggal_aktif', 'tanggal_nonaktif', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = AksesUnit::find()->joinWith(['pengguna.pegawai'])->where(['deleted_at' => null]);

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
            'pengguna_id' => $this->pengguna_id,
            'id_aplikasi' => $this->id_aplikasi,
            'tanggal_aktif' => $this->tanggal_aktif,
            'tanggal_nonaktif' => $this->tanggal_nonaktif,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        return $dataProvider;
    }
}
