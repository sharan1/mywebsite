<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Chat;

/**
 * ChatSearch represents the model behind the search form about `app\models\Chat`.
 */
class ChatSearch extends Chat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ChatID', 'RequestID', 'IsAdmin', 'IsActive'], 'integer'],
            [['Message', 'AddedOn'], 'safe'],
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
        $query = Chat::find();

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
            'ChatID' => $this->ChatID,
            'RequestID' => $this->RequestID,
            'AddedOn' => $this->AddedOn,
            'IsAdmin' => $this->IsAdmin,
            'IsActive' => $this->IsActive,
        ]);

        $query->andFilterWhere(['like', 'Message', $this->Message]);

        return $dataProvider;
    }
}
