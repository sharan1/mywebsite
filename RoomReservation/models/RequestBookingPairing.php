<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RequestBookingPairing".
 *
 * @property integer $PairingID
 * @property integer $RequestID
 * @property integer $WorkspaceID
 * @property integer $IsActive
 */
class RequestBookingPairing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RequestBookingPairing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RequestID', 'WorkspaceID'], 'required'],
            [['RequestID', 'WorkspaceID', 'IsActive'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PairingID' => 'Pairing ID',
            'RequestID' => 'Request ID',
            'WorkspaceID' => 'Workspace ID',
            'IsActive' => 'Is Active',
        ];
    }

    public function getWorkspaces()
    {
        return $this->hasMany(Workspace::className(), ['WorkspaceID' => 'WorkspaceID'])->all();
    }
}
