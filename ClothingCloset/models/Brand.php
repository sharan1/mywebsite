<?php

namespace app\models;

use Yii;

use app\models\Person;

/**
 * This is the model class for table "Brand".
 *
 * @property integer $BrandID
 * @property string $BrandName
 * @property integer $IsActive
 * @property string $AddedOn
 * @property integer $AddedBy
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsActive', 'AddedBy'], 'integer'],
            [['AddedOn'], 'safe'],
            [['BrandName'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BrandID' => 'Brand ID',
            'BrandName' => 'Brand Name',
            'IsActive' => 'Is Active',
            'AddedOn' => 'Added On',
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
