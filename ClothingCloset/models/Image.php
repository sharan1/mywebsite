<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Image".
 *
 * @property integer $ImageID
 * @property integer $ItemID
 * @property string $ImageLoc
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ItemID'], 'required'],
            [['ItemID'], 'integer'],
            [['ImageLoc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ImageID' => 'Image ID',
            'ItemID' => 'Item ID',
            'ImageLoc' => 'Image Loc',
        ];
    }
}
