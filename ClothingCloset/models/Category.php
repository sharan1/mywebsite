<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Category".
 *
 * @property integer $CategoryID
 * @property string $CategoryName
 * @property integer $IsActive
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsActive', 'AddedBy'], 'integer'],
            [['AddedOn'], 'safe'],
            [['CategoryName'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CategoryID' => 'Category ID',
            'CategoryName' => 'Category Name',
            'IsActive' => 'Is Active',
            'AddedBy' => 'Added By',
        ];
    }

    public function beforeSave($insert)
    {
        if($insert)
        {
            $this->AddedBy = !(Yii::$app->user->isGuest) ? Yii::$app->user->id : null;
        }
        return parent::beforeSave($insert);
    }

    public function getAddedBy()
    {
        return $this->hasOne(Person::className(), ['PersonID' => 'AddedBy']);
    }
}
