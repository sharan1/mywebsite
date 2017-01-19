<?php
    namespace app\components;
    use app\models\Users;
    use app\models\User;
    use yii\base\Model;

    class ResetProfilePasswordForm extends Model
    {
      public $changepassword;
      public $reenterpassword;

      public function rules()
      {
          return [
              [['changepassword','reenterpassword'], 'required'],
              ['changepassword', 'string', 'min' => 6],
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
            $this->_user = Users::findByUsername($this->username);
        }

        return $this->_user;
      }

}