<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 	/*public function authenticate() {

		$user = Users::model()->findByAttributes(array('username'=>$this->username, 'status'=>1));

		if ($user===null) { // No user found!
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if ($user->password !== md5($this->password)) { // Invalid password!
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else { // Okay!
			$user->updateLastLogin($user->id);
			$this->errorCode=self::ERROR_NONE;
		}

		return !$this->errorCode;
	}*/
	/*private $id;
 
    public function authenticate()
    {
        $user = Users::model()->findByAttributes(array('username'=>$this->username, 'status'=>1));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($user->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->id=$user->id;
			$user->updateLastLogin($this->id);
            $this->setState('roles', $user->roles);            
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId(){
        return $this->id;
    }*/
	
	     public $_id;
         public $_role;

	public function authenticate()
	{
		$users = Users::model()->findByAttributes(array('username'=>$this->username));

 
			if(!isset($users))
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			else if(!empty($users->_parentUser) && $users->_parentUser->status!='A')
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			else if( $users->password!==md5($this->password))
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			else{
				$this->_id = $users->id;
				$this->_role = $users->roles;
				$auth=Yii::app()->authManager; //initializes the authManager
				if(!$auth->isAssigned($users->roles,$this->_id)) //checks if the role for this user has already been assigned and if it is NOT than it returns true and continues with assigning it below
				{
					if($auth->assign($users->roles,$this->_id)) //assigns the role to the user
					{
						Yii::app()->authManager->save(); //saves the above declaration
					}
				}
				$this->errorCode=self::ERROR_NONE;
				return !$this->errorCode;
			}
	}
         /**
	 * Getting Logged in User id
	 */
        public function getId(){
            return $this->_id;
        }

       // This is a function that checks the field 'role'
      // in the User model to be equal to 1, that means it's admin
      // access it by Yii::app()->user->isAdmin()
      function isAdmin(){
        return $this->_role == 'admin';
      }

      public function getUserRole(){

        return "dsfsd";

      }
}