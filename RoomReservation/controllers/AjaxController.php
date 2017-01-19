<?php 
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Users;
use app\components\AdminLogin; 
use yii\db\Query;
use app\models\BookingRequest;
use app\models\RequestBookingPairing;
use app\models\Email;


class AjaxController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionMessage()
    {
        //var_dump($_POST["email"]); die;
        if($_POST["email"] != "")
        {
            if(AdminLogin::sendForgotPasswordMail($_POST['email']))
            {
                echo "Please check your email";
            }
            else
            {
                echo "Email Not found in the database. Please register";
            }

        }
        else
        {
            echo "Please enter your email";
        }
        return;
    }

    public function actionFillworkspace()
    {
        $result = '<option value>Select Workspace</option>';
        if($_POST["areaid"] != "")
        {
            $query = new Query;
            $query->select('WorkspaceID, Name')->from('Workspace')->where(['AreaID' => $_POST['areaid']]);
            $data = $query->all();
            foreach ($data as $key => $value) 
            {
                $result .= '<option value="'.$value['WorkspaceID'].'">'.$value['Name'].'</option>';
            }
        }
        echo $result;
        return;
    }

    public function actionSignupform()
    {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $check_username = Users::findByUserName($username);
        if(isset($check_username))
        {
            echo "Username must be unique";
            return;
        }
        $check_email = Users::findByEmail($email);
        if(isset($check_email))
        {
            echo "Email must be unique";
            return;
        }
        return;
    }

    public function actionBookreservation()
    {
        $list = $_POST['list'];
        $model = new BookingRequest;
        $model->UserID = Yii::$app->user->id;
        $model->StartTime = $_POST['start'];
        $model->EndTime = $_POST['end'];
        $model->Reason = $_POST['reason'];
        $model->Additional_Info = $_POST['addinfo'];
        $model->Booking_Status = 1;
        $model->save();
        
        Email::sendRequestRecievedMail($model);
        
        foreach ($list as $key => $value) 
        {
           $temp = new RequestBookingPairing;
           $temp->RequestID = $model->RequestID;
           $temp->WorkspaceID = (int)$value;
           $temp->save();
        }
    }
}
