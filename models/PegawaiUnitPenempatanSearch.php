<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PegawaiUnitPenempatan;

/**
 * PegawaiUnitPenempatanSearch represents the model behind the search form of `app\models\PegawaiUnitPenempatan`.
 */
class PegawaiUnitPenempatanSearch extends PegawaiUnitPenempatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'unit_rumpun', 'kode_unitsub_maping_simrs', 'aktif', 'is_deleted', 'is_igd', 'is_rj', 'is_ri', 'is_lab_pa', 'is_lab_pk', 'is_radiologi', 'is_ok', 'is_hd', 'is_lab_bio', 'is_radioterapi', 'is_rehab_medik', 'is_penunjang'], 'integer'],
            [['nama', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = PegawaiUnitPenempatan::find()->where(['is_deleted' => null])->orderBy(['kode'=>SORT_ASC]);

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
            'unit_rumpun' => $this->unit_rumpun,
            'kode_unitsub_maping_simrs' => $this->kode_unitsub_maping_simrs,
            'aktif' => $this->aktif,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            // 'is_deleted' => $this->is_deleted,
            'is_igd' => $this->is_igd,
            'is_rj' => $this->is_rj,
            'is_ri' => $this->is_ri,
            'is_lab_pa' => $this->is_lab_pa,
            'is_lab_pk' => $this->is_lab_pk,
            'is_radiologi' => $this->is_radiologi,
            'is_ok' => $this->is_ok,
            'is_hd' => $this->is_hd,
            'is_lab_bio' => $this->is_lab_bio,
            'is_radioterapi' => $this->is_radioterapi,
            'is_rehab_medik' => $this->is_rehab_medik,
            'is_penunjang' => $this->is_penunjang,
        ]);

        $query->andFilterWhere(['ilike', 'nama', $this->nama])
            // ->andFilterWhere(['ilike', 'created_by', $this->created_by])
            // ->andFilterWhere(['ilike', 'updated_by', $this->updated_by])
            ;

        return $dataProvider;
    }
}
