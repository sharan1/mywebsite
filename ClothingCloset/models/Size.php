<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "size".
 *
 * @property integer $ID
 * @property string $Size
 *
 * @property Allitem[] $allitems
 */
class Size extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'size';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Size'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Size' => 'Size',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllitems()
    {
        return $this->hasMany(Allitem::className(), ['size' => 'ID']);
    }
}
