<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Email".
 *
 * @property integer $MailID
 * @property integer $UserID
 * @property string $Type
 * @property string $ToEmail
 * @property string $Body
 * @property string $SentOn
 * @property string $Subject
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserID'], 'integer'],
            [['Body'], 'required'],
            [['Body'], 'string'],
            [['SentOn'], 'safe'],
            [['Type'], 'string', 'max' => 50],
            [['ToEmail'], 'string', 'max' => 25],
            [['Subject'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MailID' => 'Mail ID',
            'UserID' => 'User ID',
            'Type' => 'Type',
            'ToEmail' => 'To Email',
            'Body' => 'Body',
            'SentOn' => 'Sent On',
            'Subject' => 'Subject',
        ];
    }

    public static function sendStatusChangeMail($request_model)
    {
        $user = $request_model->user;
        if(isset($user))
        {
            if($request_model->Booking_Status == 2)
            {
                $message = "Hi ".$user->FirstName.",\n\t Congratulations!\n\n\tYour Booking Request : '$request_model->Reason' from $request_model->StartTime to $request_model->EndTime is Confirmed.\n\nRegards,\nTeam BookMyRoom\n";
                $subject = "BookMyRoom Notification: Event Confirmed";
            }
            else if($request_model->Booking_Status == 0 && Yii::$app->user->identity->PrivilegeID == 1)
            {
                $message = "Hi ".$user->FirstName.",\n\t We are sorry! Your Booking Request : '$request_model->Reason' from $request_model->StartTime to $request_model->EndTime has been cancelled due to unavoidable circumstances.\n\nRegards,\nTeam BookMyRoom\n";
                $subject = "BookMyRoom Notification: Event Cancelled";
            }
            else if($request_model->Booking_Status == 0 && Yii::$app->user->identity->PrivilegeID == 2)
            {
                $message = "Hi ".$user->FirstName.",\n\t Your Booking Request : '$request_model->Reason' from $request_model->StartTime to $request_model->EndTime has been cancelled on your request.\n\nRegards,\nTeam BookMyRoom\n";
                $subject = "BookMyRoom Notification: Event Cancelled";
            }
            else
            {
                return false;
            }

            $to = $user->Email;
            $headers = 'From: BookMyRoom <admin@bookmyroom.com>';
            Email::addNew($to, $message, $subject, 'StatusChange', $user->UserID);
            $status = mail($to, $subject, $message, $headers);
            if($status)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public static function sendRequestRecievedMail($request_model)
    {
        $user = $request_model->user;
        if(isset($user))
        {
            if($request_model->Booking_Status == 0)
            {
                $message = "Hi ".$user->FirstName.",\n\t Your Booking Request : '$request_model->Reason' from $request_model->StartTime to $request_model->EndTime has been recieved. You will get another Email upon confirmation\n\nRegards,\nTeam BookMyRoom\n";
                $subject = "BookMyRoom Notification: Request Recieved";
            }
            else
            {
                return false;
            }

            $to = $user->Email;
            $headers = 'From: BookMyRoom <admin@bookmyroom.com>';
            Email::addNew($to, $message, $subject, 'RequestRecieved', $user->UserID);
            $status = mail($to, $subject, $message, $headers);
            if($status)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public static function addNew($to, $body, $subject, $type, $user_id)
    {
        $model = new Email;
        $model->ToEmail = $to;
        $model->Body = $body;
        $model->Subject = $subject;
        $model->Type = $type;
        $model->UserID = $user_id;
        $model->save();
        return;
    }
}
