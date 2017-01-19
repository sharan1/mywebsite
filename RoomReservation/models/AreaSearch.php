<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Area;
use app\components\MapConstants;

/**
 * AreaSearch represents the model behind the search form about `app\models\Area`.
 */
class AreaSearch extends Area
{
    public $AreaType;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AreaID', 'Type', 'Num_Workspaces', 'IsActive'], 'integer'],
            [['Name', 'AreaType'], 'safe'],
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
        $query = Area::find()->where(['IsActive' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // $dataProvider->sort->attributes['AreaType'] = [
        //     'asc' => ['Type' => SORT_ASC],
        //     'desc' => ['Type' => SORT_DESC],
        // ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'AreaID' => $this->AreaID,
            'Type' => $this->Type,
            'Num_Workspaces' => $this->Num_Workspaces,
            'IsActive' => $this->IsActive,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name]);

        return $dataProvider;
    }
}
