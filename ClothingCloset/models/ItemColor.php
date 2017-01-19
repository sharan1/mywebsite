<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ItemColor".
 *
 * @property integer $ItemColorID
 * @property integer $ItemID
 * @property integer $ColorID
 * @property integer $IsActive
 */
class ItemColor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ItemColor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ItemID', 'ColorID'], 'required'],
            [['ItemID', 'ColorID', 'IsActive'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ItemColorID' => 'Item Color ID',
            'ItemID' => 'Item ID',
            'ColorID' => 'Color ID',
            'IsActive' => 'Is Active',
        ];
    }
}
