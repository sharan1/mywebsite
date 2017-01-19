<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Person;

/**
 * PersonSearch represents the model behind the search form about `app\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PersonID', 'PrivilegeID', 'IsSubscribed', 'IsActive'], 'integer'],
            [['FirstName', 'LastName', 'Type', 'ContactNum', 'Address', 'UserName', 'Password', 'PasswordHash', 'Email'], 'safe'],
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
        $query = Person::find()->where(['IsActive' => 1]);

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
            'PersonID' => $this->PersonID,
            'PrivilegeID' => $this->PrivilegeID,
            'IsSubscribed' => $this->IsSubscribed,
            'IsActive' => $this->IsActive,
        ]);

        $query->andFilterWhere(['like', 'FirstName', $this->FirstName])
            ->andFilterWhere(['like', 'LastName', $this->LastName])
            ->andFilterWhere(['like', 'Type', $this->Type])
            ->andFilterWhere(['like', 'ContactNum', $this->ContactNum])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'UserName', $this->UserName])
            ->andFilterWhere(['like', 'Password', $this->Password])
            ->andFilterWhere(['like', 'PasswordHash', $this->PasswordHash])
            ->andFilterWhere(['like', 'Email', $this->Email]);

        return $dataProvider;
    }
}
