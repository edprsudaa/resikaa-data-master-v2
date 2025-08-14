<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MedisTarifTindakanUnit;

/**
 * MedisTarifTindakanUnitSearch represents the model behind the search form of `app\models\MedisTarifTindakanUnit`.
 */
class MedisTarifTindakanUnitSearch extends MedisTarifTindakanUnit
{
    /**
     * {@inheritdoc}
     */

    public $tindakan;
    public $kelasrawat;
    public function rules()
    {
        return [
            [['tindakan', 'kelasrawat'], 'string'],
            [['id', 'tarif_tindakan_id', 'unit_id', 'aktif', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        // $query = MedisTarifTindakanUnit::find();

        $query = MedisTarifTindakanUnit::find()->alias('t1')
        ->select('t1.*, t2.*, t1.id')
        // ->select('t1.*, t2.*, t3.*')
        ->innerJoin(['t2' => MedisTarifTindakan::tableName()], 't1.tarif_tindakan_id = t2.id')
        // ->innerJoin(['t3' => MedisTindakan::tableName()], 't2.tindakan_id = t3.id')
        ->where(['t1.is_deleted' => 0]);

        // $query = \Yii::$app->db->createCommand("SELECT t1.*, t2.*, t3.*
        //                                                 FROM ".MedisTarifTindakanUnit::tableName()." t1
        //                                                 INNER JOIN ".MedisTarifTindakan::tableName()." t2 ON t1.tarif_tindakan_id = t2.id
        //                                                 INNER JOIN ".MedisTindakan::tableName()." t3 ON t2.tindakan_id = t3.id
        //                                                 WHERE t1.is_deleted != '1' "); 

        // return $query;
        // $query = MedisTarifTindakanUnit::find()->with('tariftindakan')->where(['is_deleted' => 0]);
        // $query = MedisTarifTindakanUnit::find()->where(['<>', 'is_deleted', 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'attributes' => [
                        'id',
                        'unit_id',
                        'aktif',
                        'tarif_tindakan_id',
                        'kelasrawat'
                      
                ],
                //'defaultOrder' => ['nip'=> SORT_ASC, 'nip'=> SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query
        ->andFilterWhere([
            'id' => $this->id,
            'tindakan_id' => $this->tarif_tindakan_id,
            // 'tarif_tindakan_id' => $this->tarif_tindakan_id,
            'unit_id' => $this->unit_id,
            'aktif' => $this->aktif,
            'kelas_rawat_kode' => $this->kelasrawat
        ]);
        // ->joinWith(['tariftindakan'])
        // ->andFilterWhere(['ilike', MedisTindakan::tableName() . '.deskripsi', $this->tindakan])
        // ->andFilterWhere(['ilike', MedisTarifTindakan::tableName() . '.kelas_rawat_kode', $this->kelasrawat]);

        return $dataProvider;
    }
}
