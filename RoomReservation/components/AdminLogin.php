<?php namespace app\components;

use app\models\User;
use app\models\Users;
use Yii;
use yii\base\Model;
use app\models\Email;

/**
 * Login form
 */
class AdminLogin extends Model
{

    public $UserName;
    public $Email;
    public $Password;
    public $rememberMe = true;
    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Password', 'UserName'], 'required'],
            ['rememberMe', 'boolean'],
            ['Password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) 
        {
            $user = $this->getUser();
            if ($user != NULL) 
            {
                if ($user->IsActive != 0) 
                {
                        if (!$user || !$user->verifyPassword($this->Password)) 
                        {
                            $this->addError($attribute, 'Incorrect username or password.');
                        }
                } 
                else 
                {
                    $this->addError($attribute, 'Account Blocked.');
                }
            } 
            else 
            {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->_user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) 
        {
            if(strpos($this->UserName, '@') !== false)
            {
                $this->_user = User::findByEmail($this->UserName);
            }
            else
            {
                $this->_user = User::findByUsername($this->UserName);
            }
        }
        return $this->_user;
    }

    public static function sendForgotPasswordMail($email)
    {
        $user = Users::findByEmail($email);
        if(isset($user))
        {
            $link = Yii::$app->params['domain']."".Yii::$app->request->scriptUrl.'?r=site/reset-password&hash='.$user->PasswordHash.'&username='.$user->UserName;
            $message = "Hi ".$user->FirstName.",\n\t Please reset your password by clicking on this link:\n\n\t$link\n\nRegards,\nTeam BookMyRoom\n";
            $to = $email;
            $subject = "Reset Password: BookMyRoom";
            $headers = 'From: BookMyRoom <admin@bookmyroom.com>';
            $status = mail($to, $subject, $message, $headers);

            Email::addNew($to, $message, $subject, 'ForgotPassword', $user->UserID);
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
}
