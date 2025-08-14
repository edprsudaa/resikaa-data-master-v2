<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\McuDokterPaketTindakanMcu;

/**
 * McuDokterPaketTindakanMcuSearch represents the model behind the search form about `app\models\McuDokterPaketTindakanMcu`.
 */
class McuDokterPaketTindakanMcuSearch extends McuDokterPaketTindakanMcu
{
    /**
     * @inheritdoc
     */

    public $kode_paket;
    public $kode_tindakan;
    public $kode_unit;
    public function rules()
    {
        return [
            [['kode_paket', 'kode_tindakan', 'kode_unit'], 'string'],
            [['id', 'id_paket_tindakan_mcu'], 'integer'],
            [['tanggal', 'kode_dokter'], 'safe'],
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
        $query = McuDokterPaketTindakanMcu::find()->orderBy(['id'=>SORT_DESC]);

        $query->joinWith(['tindakan']);

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
            'id' => $this->id,
            'id_paket_tindakan_mcu' => $this->id_paket_tindakan_mcu,
            'paket_tindakan_mcu.kode_paket' => $this->kode_paket,
            'paket_tindakan_mcu.kode_unit' => $this->kode_unit,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'kode_dokter', $this->kode_dokter])
              ->andFilterWhere(['like', 'paket_tindakan_mcu.kode_tindakan', $this->kode_tindakan]);

        return $dataProvider;
    }
}
