<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Donation;

/**
 * DonationSearch represents the model behind the search form about `app\models\Donation`.
 */
class DonationSearch extends Donation
{
    public $DonatedBy, $AddedByName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DonationID', 'PersonID', 'NumItems', 'AddedBy'], 'integer'],
            [['TaxDocLoc', 'AddedOn', 'DonatedBy', 'AddedByName'], 'safe'],
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
        $query = Donation::find()->join('INNER JOIN', 'Person',Donation::tableName().'.PersonID = '.Person::tableName().'.PersonID');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'DonatedBy' => [
                    'asc' => [Person::tableName().'.FirstName' => SORT_ASC],
                    'desc' => [Person::tableName().'.FirstName' => SORT_DESC]
                ],
                'AddedByName' => [
                    'asc' => [Person::tableName().'.FirstName' => SORT_ASC],
                    'desc' => [Person::tableName().'.FirstName' => SORT_DESC]
                ],
                'NumItems',
                'AddedOn'
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'DonationID' => $this->DonationID,
            'PersonID' => $this->PersonID,
            'NumItems' => $this->NumItems,
        ]);

        $query->filterWhere(['or',
            ['like','FirstName',$this->DonatedBy],
            ['like','LastName', $this->DonatedBy]
        ]);

        $query->andFilterWhere(['like', Donation::tableName().'.AddedOn', $this->AddedOn]);

        $query->filterWhere(['or',
            ['like','FirstName',$this->AddedByName],
            ['like','LastName', $this->AddedByName]
        ]);

        return $dataProvider;
    }
}
