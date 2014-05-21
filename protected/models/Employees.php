<?php

/**
 * This is the model class for table "employees".
 *
 * The followings are the available columns in table 'employees':
 * @property string $id
 * @property string $emp_id
 * @property string $name
 * @property string $email
 * @property string $joining_date
 * @property string $location
 * @property string $hall
 * @property string $manager1_id
 * @property string $manager2_id
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 *
 * The followings are the available model relations:
 * @property Managers $manager2
 * @property Managers $manager1
 */
class Employees extends AZActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_id, name, email, joining_date, location, hall, created, created_by, modified, modified_by', 'required'),
			array('emp_id, manager1_id, manager2_id', 'length', 'max'=>5),
			array('name, location, hall', 'length', 'max'=>255),
			array('email', 'length', 'max'=>75),
			array('created_by, modified_by', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_id, name, email, joining_date, location, hall, manager1_id, manager2_id, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$new_relations = array(
			'manager2' => array(self::BELONGS_TO, 'Managers', 'manager2_id'),
			'manager1' => array(self::BELONGS_TO, 'Managers', 'manager1_id'),
		);
		
		$relations = parent::relations();
		$relations = array_merge($relations, $new_relations);
		
		return $relations;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'emp_id' => 'Emp ID',
			'name' => 'Name',
			'email' => 'Email',
			'joining_date' => 'Joining Date',
			'location' => 'Location',
			'hall' => 'Hall',
			'manager1_id' => 'Manager1',
			'manager2_id' => 'Manager2',
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
		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('joining_date',$this->joining_date,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('hall',$this->hall,true);
		$criteria->compare('manager1_id',$this->manager1_id,true);
		$criteria->compare('manager2_id',$this->manager2_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		
		$records_per_page = new CDbCriteria;	// this criteria is used for getting the pagination size from cofigurations table in show record per page according this getting size
		$records_per_page->select = "records_per_page";
		$Configurations = Configurations::model()->find($records_per_page);
		$records_per_page = $Configurations['records_per_page'];
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>$records_per_page),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
    public function countByEmpID($emp_id){
        return $this->count('emp_id=:emp_id', array(':emp_id' => $emp_id));
    }
	/**
	* Returns the Employee image and his/her workspace location image. 
	*/
	public function getEmpPic($emp_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "emp_id = '$emp_id'";
		$criteria->select = "pic,location_pic";
		$empl_pic = $this->model()->find($criteria);
		return 	$empl_pic;
		
	}
	
}
