<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\color;

/**
 * colorSearch represents the model behind the search form about `app\models\color`.
 */
class colorSearch extends color
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ColorID'], 'integer'],
            [['ColorName', 'HexCode'], 'safe'],
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
        $query = color::find();

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
            'ColorID' => $this->ColorID,
        ]);

        $query->andFilterWhere(['like', 'ColorName', $this->ColorName])
            ->andFilterWhere(['like', 'HexCode', $this->HexCode]);

        return $dataProvider;
    }
}
