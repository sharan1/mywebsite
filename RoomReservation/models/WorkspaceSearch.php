<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Workspace;
use app\models\Area;

/**
 * WorkspaceSearch represents the model behind the search form about `app\models\Workspace`.
 */
class WorkspaceSearch extends Workspace
{
    public $AreaName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WorkspaceID', 'AreaID', 'Capacity', 'IsActive'], 'integer'],
            [['Name', 'AdditionalInfo', 'AreaName'], 'safe'],
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
        $query = Workspace::find()->where([Workspace::tableName().'.IsActive' => 1]);
        $query->joinWith(['area']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['AreaName'] = [
            'asc' => [Area::tableName().'.Name' => SORT_ASC],
            'desc' => [Area::tableName().'.Name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'WorkspaceID' => $this->WorkspaceID,
            'AreaID' => $this->AreaID,
            'Capacity' => $this->Capacity,
            'IsActive' => $this->IsActive,
        ]);

        $query->andFilterWhere(['like', Workspace::tableName().'.Name', $this->Name])
            ->andFilterWhere(['like', 'AdditionalInfo', $this->AdditionalInfo])
            ->andFilterWhere(['like',Area::tableName().'.Name',$this->AreaName]);;

        return $dataProvider;
    }
}
