<?php

namespace app\models;
use app\models\Person;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $data = Person::find()->where(['PersonID' => $id])->one();
        if(isset($data))
        {
            return $data;
        }
        else
        {
            return NULL;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $data = Person::find()->where(['UserName' => $username])->one();
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
        $data = Person::find()->where(['Email' => $email])->one();
        if(isset($data))
        {
            return $data;
        }
        else
        {
            return NULL;
        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
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
        return $this->password === $password;
    }
}
