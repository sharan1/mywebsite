<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\models\Category`.
 */
class CategorySearch extends Category
{
    public $AddedByName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CategoryID', 'IsActive', 'AddedBy'], 'integer'],
            [['CategoryName','AddedOn', 'AddedByName'], 'safe'],
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
        $query = Category::find()->where([Category::tableName().'.IsActive' => 1]);
        $query->joinWith(['addedBy']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['AddedByName'] = [
            'asc' => ['FirstName' => SORT_ASC],
            'desc' => ['FirstName' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->filterWhere(['or',
            ['like','FirstName',$this->AddedByName],
            ['like','LastName', $this->AddedByName]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'CategoryID' => $this->CategoryID
        ]);

        $query->andFilterWhere(['like', 'CategoryName', $this->CategoryName])
              ->andFilterWhere(['like', Category::tableName().'.AddedOn', $this->AddedOn]);

        return $dataProvider;
    }
}
