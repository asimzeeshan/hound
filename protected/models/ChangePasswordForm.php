<?php

/**
 * ChangePasswordForm class.
 */
class ChangePasswordForm extends CFormModel
{
	public $password;
	public $new_Password;
	public $confirm_Password;

	/**
	 * Declares the validation rules.
	 * The rules state that password, new password and confirm password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('password, confirm_Password, new_Password', 'required'),
            array('confirm_Password', 'compare', 'compareAttribute'=> 'new_Password','message'=> '<p style="color:red">{attribute} is not match with new password. Please same as new password.</p>'),
		    array('new_Password', 'length', 'min'=>'4', 'message'=>'<p style="color:red">Password must be atleast 4 charachters long.</p>'),
            array('password', 'verifypwd'),      // password needs to be authenticated
			
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>'Old Password',
            'confirm_Password'=>'Confirm Password',
            'new_Password'=>'New Password',

		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function verifypwd($attribute,$params)
	{
		if(!$this->hasErrors())
		{ $current_user =   Users::model()->findByPk(Yii::app()->user->id);
			if($current_user->password !== md5($this->password))
				$this->addError('password',' <p style="color:red">Old Password does not matach. Please try again.</p>');

		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function changePassword()
	{
           
            $user_pwd = Users::model()->findByPk(Yii::app()->user->id);
            $user_pwd->password = md5($this->new_Password);

            if($user_pwd->save())
                return true;
            else
                return false;
	}
}
