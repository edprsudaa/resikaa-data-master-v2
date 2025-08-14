<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MedisTarifTindakan;

/**
 * MedisTarifTindakanSearch represents the model behind the search form of `app\models\MedisTarifTindakan`.
 */
class MedisTarifTindakanSearch extends MedisTarifTindakan
{
    /**
     * {@inheritdoc}
     */

    public $Referensi;
    public function rules()
    {
        return [
            [['id', 'tindakan_id', 'sk_tarif_id', 'js_adm', 'js_sarana', 'js_bhp', 'js_dokter_operator', 'js_dokter_lainya', 'js_dokter_anastesi', 'js_penata_anastesi', 'js_paramedis', 'js_lainya', 'js_adm_cto', 'js_sarana_cto', 'js_bhp_cto', 'js_dokter_operator_cto', 'js_dokter_lainya_cto', 'js_dokter_anastesi_cto', 'js_penata_anastesi_cto', 'js_paramedis_cto', 'js_lainya_cto', 'created_by', 'updated_by', 'is_deleted', 'Referensi'], 'integer'],
            [['kelas_rawat_kode', 'created_at', 'updated_at'], 'safe'],
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

      public function searchTarifTindakan($params, $id)
    {
        // $query = MedisTarifTindakan::find()->alias('a')->joinWith('tindakan')->where(['<>', 'a.is_deleted', 1]);
        $query  = MedisTarifTindakan::find()->alias('a')
                                    ->where(['and',['tindakan_id' => $id],['<>','a.is_deleted',1]])
                                    ->joinWith(['medisTindakan','kelasrawat','sktarif']);

        $dataProviderTarifTindakan = new ActiveDataProvider([
            'query' => $query,
        ]);

         $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProviderTarifTindakan;
        }

         $query->andFilterWhere([
            'id' => $this->id,
            'kelas_rawat_kode'  => $this->kelas_rawat_kode,
            'sk_tarif_id'       => $this->sk_tarif_id,
        ]);

        $query->andFilterWhere(['ilike', 'kelas_rawat_kode', $this->kelas_rawat_kode])
            ->andFilterWhere(['ilike', 'sk_tarif_id', $this->sk_tarif_id]);

        return $dataProviderTarifTindakan;
    }

    
    public function search($params)
    {
        $query = MedisTarifTindakan::find()->alias('a')->joinWith('tindakan')->where(['<>', 'a.is_deleted', 1]);

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
            'tindakan_id' => $this->tindakan_id,
            'sk_tarif_id' => $this->sk_tarif_id,
            'js_adm' => $this->js_adm,
            'js_sarana' => $this->js_sarana,
            'js_bhp' => $this->js_bhp,
            'js_dokter_operator' => $this->js_dokter_operator,
            'js_dokter_lainya' => $this->js_dokter_lainya,
            'js_dokter_anastesi' => $this->js_dokter_anastesi,
            'js_penata_anastesi' => $this->js_penata_anastesi,
            'js_paramedis' => $this->js_paramedis,
            'js_lainya' => $this->js_lainya,
            'js_adm_cto' => $this->js_adm,
            'js_sarana_cto' => $this->js_sarana,
            'js_bhp_cto' => $this->js_bhp,
            'js_dokter_operator_cto' => $this->js_dokter_operator,
            'js_dokter_lainya_cto' => $this->js_dokter_lainya,
            'js_dokter_anastesi_cto' => $this->js_dokter_anastesi,
            'js_penata_anastesi_cto' => $this->js_penata_anastesi,
            'js_paramedis_cto' => $this->js_paramedis,
            'js_lainya_cto' => $this->js_lainya,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
            MedisTindakan::tableName(). '.id' => $this->Referensi,
        ]);

        $query->andFilterWhere(['ilike', 'kelas_rawat_kode', $this->kelas_rawat_kode])
          ->andFilterWhere(['ilike', 'sk_tarif_id', $this->sk_tarif_id]);

        return $dataProvider;
    }
}
