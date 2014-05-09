<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $status
 * @property string $last_login
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class Users extends AZActiveRecord
{
	    const ENABLE=1;
		const DISABLE=0;
		
		const ADMIN= 'admin';
		const MANAGER='manager';
		const GUEST='guest';
	
	public function getStatusOptions()
	{
		// display status value in drop down list
		return array(
			self::ENABLE=>'Enable',
			self::DISABLE=>'Disable',
					);
	}
	public function getRolesOptions()
	{
		// display the roles for users in drop down list
		return array(
			self::ADMIN=>'Admin',
			self::MANAGER=>'Manager',
			self::GUEST=>'Guest',
					);
	}
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, username, password, email, last_login, created_by, modified, modified_by', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('status', 'in', 'range'=>self::getStatusRange()), // check status in range
			array('roles', 'in', 'range'=>self::getRolesRange()),	// check roles in range
			array('first_name, last_name, username, email', 'length', 'max'=>75),
			array('password', 'length', 'max'=>255),
			array('created_by, modified_by', 'length', 'max'=>11),
			array('created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, username, password, email, status, roles, last_login, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
		);
	}
	
	public static function getStatusRange()
	{
		// check the value of status in range
			return array(
			self::ENABLE,
			self::DISABLE,
			);
	}
	
	public static function getRolesRange()
	{
		// check the roles for users are in range
			return array(
			self::ADMIN,
			self::MANAGER,
			self::GUEST,
			);
	}
  
	public function getStatusText()
	{
		//this is used for display status text
		$statusOptions=$this->statusOptions;
		return isset($statusOptions[$this->status]) ?
		$statusOptions[$this->status] : "unknown status ({$this->status})";
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$relations = parent::relations();
		return $relations;
	}
	
	/**
	 * @return array beforeValidate
	 */	
    protected function beforeValidate() {
		if ($this->isNewRecord) {
			$this->last_login 		= '0000-00-00 00:00:00';
		}

		return parent::beforeValidate();
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'status' => 'Status',
			'roles'=>'Roles',
			'last_login' => 'Last Login',
			'created' => 'Created',
			'created_by' => 'Created By',
			'modified' => 'Modified',
			'modified_by' => 'Modified By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>25,),
		));
	}
	
	public function getUserLofinInfo($email)
	{
		
		    $criteria = new CDbCriteria();
			$criteria->condition = "email = '$email'";
			$criteria->select = "first_name, last_name, username, password, email ";
			$Devices =Users:: model()->findAll($criteria);
			$login_data = "<br /><strong>User Login Information </strong>:<br /> <br />
		      <table border=1 width='95%'>
			  <th width='45%'> First Name</th>
			  <th width='16%'>Last Name</th>
			  <th width='16%'>Username</th>
			  <th width='16%'>Password</th>
			  <th width='16%'>Email</th>  ";
		           foreach($Devices as $query){
					//$userLink = CHtml::link($query->name,array("devices/update","id"=>$query->id));
			       	$login_data .= "<tr><td align='center'>".$query->first_name."</td>
					      <td align='center'>". $query->last_name."</td>
					      <td align='center'>". $query->username."</td>
					      <td align='center'>". $query->password."</td>
						  <td align='center'>". $query->email."</td></tr>";
				}
				   $login_data .= "</table>";
				   return $login_data;
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	// update the last login time
	public function updateLastLogin($primary_key) {
		return $this->updateByPk(array($primary_key), array( "last_login" => new CDbExpression('NOW()')));
	}
	
	// return the full name (first_name & last_name)
	public function name() {
		return $this->first_name." ".$this->last_name; 	
	}
}
