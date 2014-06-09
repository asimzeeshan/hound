<?php 
class WebUser extends CWebUser
{
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
   // Store model to not repeat query.
 	 private $_model;

  
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
	 public function isAdmin(){
		if(!Yii::app()->user->isGuest){
			$user = $this->loadUser(Yii::app()->user->id);
			return $user->roles == "admin";
		}
		else{
			return false;
		}
	  }
  
	 public function isManager(){
		   if(!Yii::app()->user->isGuest){
				$user = $this->loadUser(Yii::app()->user->id);
				return ( $user->roles == "manager");
			}
			else{
				return false;
			}
	  }
	
	  public function isSuperAdmin(){
		   if(!Yii::app()->user->isGuest){
			$user = $this->loadUser(Yii::app()->user->id);
			return $user->roles == "superadmin";
		}
		else{
			return false;
		}
	  }
	  
	  public function isSystemAdmin($id){
		   if($id == 1){
			$user = $this->loadUser($id);
			return $user->username;
		}
		else{
			return false;
		}
	  }
	  
	   public function isGuest(){
		   if(!Yii::app()->user->isGuest){
			$user = $this->loadUser(Yii::app()->user->id);
			return $user->roles == "guest";
		}
		else{
			return false;
		}
	  }
	
	 
	 public function getRole(){
		  $user = $this->loadUser(Yii::app()->user->id);
		  return $user->roles;
	  }
	
	  // Load user model.
	  protected function loadUser($id=null)
		{
		  if($id==null)
			  throw new CHttpException(400, 'You are not authorized to access this module');
			if($this->_model===null)
			{
				if($id!==null)
					$this->_model=Users::model()->findByPk($id);
			}
	
			return $this->_model;
		}
}
?>