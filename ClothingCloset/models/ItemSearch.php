<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Allitem;
use app\models\Donation;
use app\models\Person;
use app\models\Brand;

/**
 * itemSearch represents the model behind the search form about `app\models\Allitem`.
 */
class ItemSearch extends AllItem
{
    public $DonatedBy, $BrandName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ItemID', 'DonationID', 'BrandID', 'IsPriceDec', 'IsActive', 'AddedBy'], 'integer'],
            [['Price'], 'number'],
            [['AddedOn', 'ItemName', 'DonatedBy', 'BrandName'], 'safe'],
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
        $query = AllItem::find()->where([AllItem::tableName().'.IsActive' => 1]);
        $query->join('INNER JOIN', 'Donation',Donation::tableName().'.DonationID = '.AllItem::tableName().'.DonationID')
              ->join('INNER JOIN', 'Person',Donation::tableName().'.PersonID = '.Person::tableName().'.PersonID')
              ->join('INNER JOIN', 'Brand',Brand::tableName().'.BrandID = '.AllItem::tableName().'.BrandID');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'ItemName',
                'Price',
                'DonatedBy' => [
                    'asc' => [Person::tableName().'.FirstName' => SORT_ASC],
                    'desc' => [Person::tableName().'.FirstName' => SORT_DESC]
                ],
                'BrandName' => [
                    'asc' => [Brand::tableName().'.BrandName' => SORT_ASC],
                    'desc' => [Brand::tableName().'.BrandName' => SORT_DESC]
                ],
                'IsPriceDec'
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
            'Price' => $this->Price,
            'IsPriceDec' => $this->IsPriceDec,
            'IsActive' => $this->IsActive,
            'AddedOn' => $this->AddedOn,
            'AddedBy' => $this->AddedBy
        ]);
        $query->filterWhere(['or',
            ['like','FirstName',$this->DonatedBy],
            ['like','LastName', $this->DonatedBy]
        ]);

        $query->andFilterWhere(['like', 'BrandName', $this->BrandName])
              ->andFilterWhere(['like', 'ItemName', $this->ItemName]);
        return $dataProvider;
    }
}
