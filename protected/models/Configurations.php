<?php

/**
 * This is the model class for table "configurations".
 *
 * The followings are the available columns in table 'configurations':
 * @property integer $id
 * @property string $title
 * @property string $from_name
 * @property string $from_email
 * @property string $bcc
 * @property string $notify_email
 * @property integer $records_per_page
 * @property string $created
 * @property integer $created_by
 * @property string $modified
 * @property integer $modified_by
 */
class Configurations extends AZActiveRecord
{
	 const FIRST_RECORD=10;
	 const SECOND_RECORD=20;
	 const THIRD_RECORD=25;
	 const FOURTH_RECORD=50;
	 const FIFTH_RECORD=100;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'configurations';
	}
	/*
	* Return records per page as per your requirments in drop downl list.
	*/
	public function getRecordsOptions()
	{
		// display records per page value in drop down list
		return array(
			self::FIRST_RECORD=>'10',
			self::SECOND_RECORD=>'20',
			self::THIRD_RECORD=>'25',
			self::FOURTH_RECORD=>'50',
			self::FIFTH_RECORD=>'100',
					);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_name, from_email, notify_email, created, created_by, modified, modified_by', 'required'),
			array('records_per_page, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('records_per_page', 'in', 'range'=>self::getRecordsRange()), // check records per page vlaue in range
			array('title, from_name, from_email, bcc, notify_email', 'length', 'max'=>75),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, from_name, from_email, bcc, notify_email, records_per_page, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
		);
	}
	/*
	* Check the value of records per page in range which your are define above.
	*/
	public static function getRecordsRange()
	{
		// check the value of record per page in range
		return array(
			self::FIRST_RECORD,
			self::SECOND_RECORD,
			self::THIRD_RECORD,
			self::FOURTH_RECORD,
			self::FIFTH_RECORD,
					);
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Application Title',
			'from_name' => 'From Name',
			'from_email' => 'From Email',
			'bcc' => 'Bcc',
			'notify_email' => 'Notify Email',
			'records_per_page' => 'Records Per Page',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('from_name',$this->from_name,true);
		$criteria->compare('from_email',$this->from_email,true);
		$criteria->compare('bcc',$this->bcc,true);
		$criteria->compare('notify_email',$this->notify_email,true);
		$criteria->compare('records_per_page',$this->records_per_page);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Configurations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/*
	* Return title field 
	*/
	public function applicationsPagetitle()
	{
		$criteria = new CDbCriteria();
		$criteria->select = "title";
		$applicationsPageTitle = configurations::model()->find($criteria);
		$pageTitle = $applicationsPageTitle['title'];		
		if(!empty($pageTitle))
		return $pageTitle;
		else
		return Yii::app()->name;
	}
	/*
	* Return the from_email and notify_email from configurations table
	*/
	public function applicationsEmail()
	{
		$criteria = new CDbCriteria();
		$criteria->select = "from_email, notify_email";
		$email = configurations::model()->findAll($criteria);		
		return $email;	
	}
	
	
}
