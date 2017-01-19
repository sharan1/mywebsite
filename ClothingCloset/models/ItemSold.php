<?php

namespace app\models;

use Yii;
use app\models\Person;

/**
 * This is the model class for table "ItemSold".
 *
 * @property integer $ItemID
 * @property integer $CustomerID
 * @property string $AddedOn
 * @property integer $AddedBy
 */
class ItemSold extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ItemSold';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerID'], 'integer'],
            [['AddedOn'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ItemID' => 'Item ID',
            'CustomerID' => 'Customer ID',
            'AddedOn' => 'Added On',

        ];
    }
   
    public function getItem()
    {
        return AllItem::find()->where(['ItemID' => $this->ItemID])->one();
    }

    public function getBuyer()
    {
        return Person::find()->where(['PersonID' => $this->CustomerID])->one();
    } 
}
