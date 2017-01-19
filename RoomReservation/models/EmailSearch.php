<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Email;

/**
 * EmailSearch represents the model behind the search form about `app\models\Email`.
 */
class EmailSearch extends Email
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MailID', 'Type'], 'integer'],
            [['ToEmail', 'Body', 'SentOn'], 'safe'],
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
        $query = Email::find();

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
            'MailID' => $this->MailID,
            'Type' => $this->Type,
            'SentOn' => $this->SentOn,
        ]);

        $query->andFilterWhere(['like', 'ToEmail', $this->ToEmail])
            ->andFilterWhere(['like', 'Body', $this->Body]);

        return $dataProvider;
    }
}
