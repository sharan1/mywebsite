<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ItemCategory".
 *
 * @property integer $ItemCategoryID
 * @property integer $ItemID
 * @property integer $CategoryID
 * @property integer $IsActive
 */
class ItemCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ItemCategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ItemID', 'CategoryID'], 'required'],
            [['ItemID', 'CategoryID', 'IsActive'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ItemCategoryID' => 'Item Category ID',
            'ItemID' => 'Item ID',
            'CategoryID' => 'Category ID',
            'IsActive' => 'Is Active',
        ];
    }
}
