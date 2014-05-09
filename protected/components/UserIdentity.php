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
	 	private $id;

	public function authenticate() {
		$user = Users::model()->findByAttributes(array('username'=>$this->username, 'status'=>1));

		if ($user===null) { // No user found!
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else if ($user->password !== md5($this->password)) { // Invalid password!
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else { // Okay!
			$user->updateLastLogin($user->id);
			//$this->id=$user->id;
            $this->id=$user->id;
            $this->setState('roles', $user->roles);            
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId(){
        return $this->id;
    }
}