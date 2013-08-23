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
class Users extends CActiveRecord
{
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
			array('first_name, last_name, username, password, email', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, username, email', 'length', 'max'=>75),
			array('password', 'length', 'max'=>255),
			array('created_by, modified_by', 'length', 'max'=>11),
			array('created', 'safe'),
			//array('last_login,created,modified','date','format'=>Yii::app()->locale->getDateFormat('short')),
			array('modified','default','value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
			array('created,modified','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, username, password, email, status', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * @return array beforeSave
	 */	
	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->created 		= new CDbExpression('NOW()');
			$this->created_by 	= Yii::app()->user->name;
		}
		
		$this->modified 	= new CDbExpression('NOW()');
		$this->modified_by 	= Yii::app()->user->name;

		return parent::beforeSave();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
	
	public static function updateLastLogin($primary_key) {
		return $this->updateByPk(array($primary_key), array( "last_login" => new CDbExpression('NOW()')));
	}

	protected function afterFind()
	{
		// Format dates based on the locale
		foreach($this->metadata->tableSchema->columns as $columnName => $column)
		{           
			if (!strlen($this->$columnName)) continue;
	 
			if ($column->dbType == 'date')
			{ 
				$this->$columnName = Yii::app()->dateFormatter->formatDateTime(
						CDateTimeParser::parse(
							$this->$columnName, 
							'yyyy-MM-dd'
						),
						'medium',null
					);
			}
			elseif ($column->dbType == 'datetime' || $column->dbType == 'timestamp')
			{
				$this->$columnName = Yii::app()->dateFormatter->formatDateTime(
						CDateTimeParser::parse(
							$this->$columnName, 
							'yyyy-MM-dd hh:mm:ss'
						),
						'medium','short'
					);
			}
		}
		return parent::afterFind();
	}
}
