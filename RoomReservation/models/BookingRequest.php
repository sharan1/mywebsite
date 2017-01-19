<?php

namespace app\models;

use Yii;
use app\models\Users;
use app\models\RequestBookingPairing;
use yii\db\Query;

/**
 * This is the model class for table "BookingRequest".
 *
 * @property integer $RequestID
 * @property integer $UserID
 * @property string $RequestedOn
 * @property string $StartTime
 * @property string $EndTime
 * @property string $Reason
 * @property integer $Booking_Status
 * @property string $Additional_Info
 * @property string $Last_Updated
 */
class BookingRequest extends \yii\db\ActiveRecord
{
    public $workspace_details;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'BookingRequest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserID','StartTime','EndTime','Reason'], 'required'],
            [['UserID', 'Booking_Status'], 'integer'],
            [['RequestedOn', 'StartTime', 'EndTime', 'Last_Updated', 'workspace_details'], 'safe'],
            [['Reason', 'Additional_Info'], 'string'],
            ['EndTime','compare','compareAttribute'=>'StartTime','operator'=>'>', 'message'=>'{attribute} must be greater than "{compareValue}".'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RequestID' => 'Request ID',
            'UserID' => 'Requestor',
            'RequestedOn' => 'Requested On',
            'StartTime' => 'Start Time',
            'EndTime' => 'End Time',
            'Reason' => 'Purpose',
            'Booking_Status' => 'Booking  Status',
            'Additional_Info' => 'Additional Requirements(If any)',
            'Last_Updated' => 'Last  Updated',
        ];
    }

    public function getUser()
    {
        return Users::find()->where(['UserID' => $this->UserID])->one();
    }

    public function getWorkspaces()
    {
        $result = [];
        $pairings = $this->hasMany(RequestBookingPairing::className(), ['RequestID' => 'RequestID'])->all();
        foreach ($pairings as $key => $value) 
        {
            $temp = $value->workspaces;
            foreach ($temp as $key1 => $value1) 
            {
                $result[] = $value1;
            }
        }
        return $result;
    }

    public function afterFind()
    {

        parent::afterFind();
        $query = new Query;
        $query->select('WorkspaceID')->from('RequestBookingPairing')->where(['RequestID' => $this->RequestID]);
        $data = $query->all();
        $this->workspace_details = array_column($data, 'WorkspaceID');
    }

    public function beforeSave($insert)
    {
        if(!isset($this->UserID))
        {
            $this->UserID = Yii::$app->user->id;
        }
        $this->StartTime = \DateTime::createFromFormat('Y-m-d H:i:s', $this->StartTime)->format('Y-m-d H:i:s');
        $this->EndTime = \DateTime::createFromFormat('Y-m-d H:i:s', $this->EndTime)->format('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if(isset($this->workspace_details) && !empty($this->workspace_details))
        {
            if(!$insert)
            {
                $pairings = RequestBookingPairing::find()->where(['RequestID' => $this->RequestID])->all();
                foreach($pairings as $key => $value) 
                {
                    $value->delete();
                }
            }
            foreach($this->workspace_details as $key => $value) 
            {
                $new = new RequestBookingPairing;
                $new->RequestID = $this->RequestID;
                $new->WorkspaceID = $value;
                $new->save();
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }
    
}
