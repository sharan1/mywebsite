<?php
    namespace app\components;
    use app\models\Person;
    use app\models\User;
    use yii\base\Model;

    class ResetProfilePasswordForm extends Model
    {
      public $changepassword;
      public $reenterpassword;

      public function rules()
      {
          return [
              ['changepassword', 'required'],
              ['reenterpassword', 'required'],
              ['reenterpassword', 'compare', 'compareAttribute'=>'changepassword', 'message'=>"Passwords don't match"]
          ];
      }

      public function attributeLabels()
      {
          return [
              'changepassword' => 'New Password',
              'reenterpassword' => 'Re-enter New Password',
          ];
      }

      protected function getUser()
      {
        if ($this->_user === null) 
        {
            $this->_user = Person::findByUsername($this->username);
        }

        return $this->_user;
      }

}