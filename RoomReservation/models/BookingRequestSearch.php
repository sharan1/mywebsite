<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BookingRequest;

/**
 * BookingRequestSearch represents the model behind the search form about `app\models\BookingRequest`.
 */
class BookingRequestSearch extends BookingRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RequestID', 'UserID', 'Booking_Status'], 'integer'],
            [['RequestedOn', 'StartTime', 'EndTime', 'Reason', 'Additional_Info', 'Last_Updated'], 'safe'],
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
        $query = BookingRequest::find()->where(['Booking_Status' => 1])->orderBy('RequestedOn DESC');

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
            'RequestID' => $this->RequestID,
            'UserID' => $this->UserID,
            'RequestedOn' => $this->RequestedOn,
            'StartTime' => $this->StartTime,
            'EndTime' => $this->EndTime,
            'Booking_Status' => $this->Booking_Status,
            'Last_Updated' => $this->Last_Updated,
        ]);

        $query->andFilterWhere(['like', 'Reason', $this->Reason])
            ->andFilterWhere(['like', 'Additional_Info', $this->Additional_Info]);

        return $dataProvider;
    }
}
