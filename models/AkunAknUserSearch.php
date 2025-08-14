<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AkunAknUser;

/**
 * AkunAknUserSearch represents the model behind the search form of `app\models\AkunAknUser`.
 */
class AkunAknUserSearch extends AkunAknUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'id_pegawai', 'status'], 'integer'],
            [['username', 'password', 'nama', 'tanggal_pendaftaran', 'role', 'token_aktivasi'], 'safe'],
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
        $query = AkunAknUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => $this->userid,
            'id_pegawai' => $this->id_pegawai,
            'tanggal_pendaftaran' => $this->tanggal_pendaftaran,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'role', $this->role])
            ->andFilterWhere(['ilike', 'token_aktivasi', $this->token_aktivasi]);

        return $dataProvider;
    }
}
