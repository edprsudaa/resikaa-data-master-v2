<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KomputerRs;

/**
 * AksesUnitSearch represents the model behind the search form of `app\models\KomputerRs`.
 */
class KomputerRsSearch extends KomputerRs
{

    public $notifikasi_status;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['id', 'kode_unit'], 'integer'],        
            [['keterangan', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['created_at', 'updated_at', 'deleted_at','ip_address','mac_address','nama_ruangan', 'notifikasi_status'], 'safe'],
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
        $query = KomputerRs::find()->with('unitPenempatan')->where(['is_deleted' => 0])->orderBy(['id'=> SORT_DESC]);

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
            'kode_unit' => $this->kode_unit,
            'ip_address' => $this->ip_address,
            'mac_address' => $this->mac_address,
            'nama_ruangan' => $this->nama_ruangan,
            'keterangan' => $this->keterangan,
            'is_notifikasi' => $this->notifikasi_status,
        ]);

        return $dataProvider;
    }
}
