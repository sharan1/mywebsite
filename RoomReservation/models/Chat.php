<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Chat".
 *
 * @property integer $ChatID
 * @property integer $RequestID
 * @property string $Message
 * @property string $AddedOn
 * @property integer $IsAdmin
 * @property integer $IsActive
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RequestID', 'Message'], 'required'],
            [['RequestID', 'IsAdmin', 'IsActive'], 'integer'],
            [['Message'], 'string'],
            [['AddedOn'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ChatID' => 'Chat ID',
            'RequestID' => 'Request ID',
            'Message' => 'Message',
            'AddedOn' => 'Added On',
            'IsAdmin' => 'Is Admin',
            'IsActive' => 'Is Active',
        ];
    }
}
