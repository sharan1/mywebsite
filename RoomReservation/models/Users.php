<?php

namespace app\models;

use Yii;
use app\models\Privilege;

class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $confirmPassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FirstName', 'LastName', 'UserName', 'Email', 'PrivilegeID'], 'required'],
            [['PrivilegeID', 'IsActive'], 'integer'],
            [['FirstName', 'LastName'], 'string', 'max' => 55],
            [['Email', 'UserName'], 'string', 'max' => 50],
            [['UserName','Email'], 'unique'],
            [['Password', 'PasswordHash','confirmPassword'], 'string', 'max' => 75],
            [['confirmPassword'], 'safe'],
            [['PhoneNum'], 'string', 'max' => 15],
            ['Password', 'string', 'min' => 6],
            ['confirmPassword', 'compare', 'compareAttribute' => 'Password', 'message' => 'The password does not match.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserID' => 'User ID',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'Email' => 'Email',
            'UserName' => 'User Name',
            'Password' => 'Password',
            'PasswordHash' => 'Password Hash',
            'PhoneNum' => 'Phone Num',
            'PrivilegeID' => 'Privilege',
            'IsActive' => 'Is Active',
            'confirmPassword' => 'Confirm Password'
        ];
    }

    public function verifyPassword($password)
    {
        if($this->Password == md5($password))
            return true;
        else
            return false;
    }

    public static function findByUsername($username)
    {
        $data = Users::find()->where(['UserName' => $username])->one();
        if(isset($data))
        {
            return $data;
        }
        else
        {
            return NULL;
        }
    }

    public static function findByEmail($email)
    {
        $data = Users::find()->where(['Email' => $email])->one();
        if(isset($data))
        {
            return $data;
        }
        else
        {
            return NULL;
        }
    }

    public static function findIdentity($id)
    {
        $data = Users::find()->where(['UserID' => $id])->one();
        if(isset($data))
        {
            return $data;
        }
        else
        {
            return NULL;
        }
    }

    public function getId()
    {
        return $this->UserID;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public function getPrivilege()
    {
        return Privilege::find()->where(['PrivilegeID' => $this->PrivilegeID])->one();
    }

    public function getFullName()
    {
        return $this->FirstName." ".$this->LastName;
    }

    public function beforeSave($insert)
    {
        if($insert)
        {
            if(!isset($this->Password) || empty($this->Password))
                $this->Password = "welcome";
            $this->Password = md5($this->Password);
            $this->PasswordHash = Yii::$app->getSecurity()->generateRandomString();
        }
        return parent::beforeSave($insert);
    }
}

?>
