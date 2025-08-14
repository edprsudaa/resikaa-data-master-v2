<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TindKel;

/**
 * TindKelSearch represents the model behind the search form about `app\models\TindKel`.
 */
class TindKelSearch extends TindKel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KELOMPOK', 'TINDAKAN', 'KDKEL', 'KODE1', 'KODE2', 'FileReport', 'Jenis', 'KodeKelDokter', 'KodeKelPely', 'KodeKelPenerima_Rem', 'Parent', 'KodeRL_1_4', 'KodeRL_1_5', 'KodeRL_1_6', 'KodeRL_1_7', 'KodeRL_1_8', 'KodeRL_1_9A', 'KodeRL_1_9B', 'KodeRL_1_9C', 'KodeRL_1_9D', 'KodeRL_1_10', 'KodeRL_1_11A', 'KodeRL_1_11B', 'KodeRL_1_11C', 'KodeRL_1_13', 'KodeRL_1_14', 'KodeRL_1_15', 'KodeRL_1_16', 'KodeRL_1_20A', 'KodeRL_1_20B', 'KodeRL_1_20C', 'KodeRL_1_20D', 'KodeRL_1_5_Kat', 'KodeRL_1_11A_Kat', 'KodeRL_1_11B_Kat'], 'safe'],
            [['lPilih', 'lHeader', 'lManual', 'lJumlah', 'lCytoHarga_Bhn', 'lCytoJs_RS', 'lCytoJs_MedL', 'lCytoJs_MedTL', 'lReg', 'lDrSpesialis', 'lNonAktif'], 'integer'],
            [['Pajak', 'Cyto', 'CytoHarga_Bhn', 'CytoJs_RS', 'CytoJs_MedL', 'CytoJs_MedTL'], 'number'],
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
        $query = TindKel::find();

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
            'lPilih' => $this->lPilih,
            'lHeader' => $this->lHeader,
            'lManual' => $this->lManual,
            'Pajak' => $this->Pajak,
            'Cyto' => $this->Cyto,
            'lJumlah' => $this->lJumlah,
            'lCytoHarga_Bhn' => $this->lCytoHarga_Bhn,
            'lCytoJs_RS' => $this->lCytoJs_RS,
            'lCytoJs_MedL' => $this->lCytoJs_MedL,
            'lCytoJs_MedTL' => $this->lCytoJs_MedTL,
            'CytoHarga_Bhn' => $this->CytoHarga_Bhn,
            'CytoJs_RS' => $this->CytoJs_RS,
            'CytoJs_MedL' => $this->CytoJs_MedL,
            'CytoJs_MedTL' => $this->CytoJs_MedTL,
            'lReg' => $this->lReg,
            'lDrSpesialis' => $this->lDrSpesialis,
            'lNonAktif' => $this->lNonAktif,
        ]);

        $query->andFilterWhere(['like', 'KELOMPOK', $this->KELOMPOK])
            ->andFilterWhere(['like', 'TINDAKAN', $this->TINDAKAN])
            ->andFilterWhere(['like', 'KDKEL', $this->KDKEL])
            ->andFilterWhere(['like', 'KODE1', $this->KODE1])
            ->andFilterWhere(['like', 'KODE2', $this->KODE2])
            ->andFilterWhere(['like', 'FileReport', $this->FileReport])
            ->andFilterWhere(['like', 'Jenis', $this->Jenis])
            ->andFilterWhere(['like', 'KodeKelDokter', $this->KodeKelDokter])
            ->andFilterWhere(['like', 'KodeKelPely', $this->KodeKelPely])
            ->andFilterWhere(['like', 'KodeKelPenerima_Rem', $this->KodeKelPenerima_Rem])
            ->andFilterWhere(['like', 'Parent', $this->Parent])
            ->andFilterWhere(['like', 'KodeRL_1_4', $this->KodeRL_1_4])
            ->andFilterWhere(['like', 'KodeRL_1_5', $this->KodeRL_1_5])
            ->andFilterWhere(['like', 'KodeRL_1_6', $this->KodeRL_1_6])
            ->andFilterWhere(['like', 'KodeRL_1_7', $this->KodeRL_1_7])
            ->andFilterWhere(['like', 'KodeRL_1_8', $this->KodeRL_1_8])
            ->andFilterWhere(['like', 'KodeRL_1_9A', $this->KodeRL_1_9A])
            ->andFilterWhere(['like', 'KodeRL_1_9B', $this->KodeRL_1_9B])
            ->andFilterWhere(['like', 'KodeRL_1_9C', $this->KodeRL_1_9C])
            ->andFilterWhere(['like', 'KodeRL_1_9D', $this->KodeRL_1_9D])
            ->andFilterWhere(['like', 'KodeRL_1_10', $this->KodeRL_1_10])
            ->andFilterWhere(['like', 'KodeRL_1_11A', $this->KodeRL_1_11A])
            ->andFilterWhere(['like', 'KodeRL_1_11B', $this->KodeRL_1_11B])
            ->andFilterWhere(['like', 'KodeRL_1_11C', $this->KodeRL_1_11C])
            ->andFilterWhere(['like', 'KodeRL_1_13', $this->KodeRL_1_13])
            ->andFilterWhere(['like', 'KodeRL_1_14', $this->KodeRL_1_14])
            ->andFilterWhere(['like', 'KodeRL_1_15', $this->KodeRL_1_15])
            ->andFilterWhere(['like', 'KodeRL_1_16', $this->KodeRL_1_16])
            ->andFilterWhere(['like', 'KodeRL_1_20A', $this->KodeRL_1_20A])
            ->andFilterWhere(['like', 'KodeRL_1_20B', $this->KodeRL_1_20B])
            ->andFilterWhere(['like', 'KodeRL_1_20C', $this->KodeRL_1_20C])
            ->andFilterWhere(['like', 'KodeRL_1_20D', $this->KodeRL_1_20D])
            ->andFilterWhere(['like', 'KodeRL_1_5_Kat', $this->KodeRL_1_5_Kat])
            ->andFilterWhere(['like', 'KodeRL_1_11A_Kat', $this->KodeRL_1_11A_Kat])
            ->andFilterWhere(['like', 'KodeRL_1_11B_Kat', $this->KodeRL_1_11B_Kat]);

        return $dataProvider;
    }
}
