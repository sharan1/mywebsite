<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Area".
 *
 * @property integer $AreaID
 * @property string $Name
 * @property integer $Type
 * @property integer $Num_Workspaces
 * @property integer $IsActive
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Num_Workspaces', 'Type'], 'required'],
            [['Type', 'Num_Workspaces', 'IsActive'], 'integer'],
            [['Name'], 'string', 'max' => 55],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AreaID' => 'Area',
            'Name' => 'Name',
            'Type' => 'Type',
            'Num_Workspaces' => 'Num  Workspaces',
            'IsActive' => 'Is Active',
        ];
    }
}
