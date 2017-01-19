<?php 
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Person;
use app\components\AdminLogin; 


class AjaxController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionMessage()
    {
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

    public function actionSignupform()
    {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $check_username = Person::findByUserName($username);
        if(isset($check_username))
        {
            echo "Username must be unique";
            return;
        }
        $check_email = Person::findByEmail($email);
        if(isset($check_email))
        {
            echo "Email must be unique";
            return;
        }
        return;
    }
}
