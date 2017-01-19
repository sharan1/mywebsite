<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Color".
 *
 * @property integer $ColorID
 * @property string $ColorName
 * @property string $HexCode
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ColorName'], 'string', 'max' => 20],
            [['HexCode'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ColorID' => 'Color ID',
            'ColorName' => 'Color Name',
            'HexCode' => 'Hex Code',
        ];
    }
}
