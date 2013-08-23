<?php

/**
 * This is the model class for table "employees".
 *
 * The followings are the available columns in table 'employees':
 * @property string $id
 * @property string $emp_id
 * @property string $name
 * @property string $ip_address
 * @property string $mac_address
 * @property string $hostname
 * @property string $description
 * @property string $line_manager
 * @property string $location
 * @property string $hall
 * @property string $opt
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
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
			array('name, ip_address, mac_address, hostname, description, line_manager, location, hall, opt, created_by, modified, modified_by', 'required'),
			array('emp_id, name, ip_address, mac_address, hostname, description, line_manager, location, hall', 'length', 'max'=>255),
			array('opt', 'length', 'max'=>256),
			array('created_by, modified_by', 'length', 'max'=>11),
			array('created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_id, name, ip_address, mac_address, hostname, description, line_manager, location, hall, opt, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
			'emp_id' => 'EmpID',
			'name' => 'Name',
			'ip_address' => 'IP',
			'mac_address' => 'MAC',
			'hostname' => 'Hostname',
			'description' => 'Description',
			'line_manager' => 'Line Manager',
			'location' => 'Location',
			'hall' => 'Hall',
			'opt' => 'Seg Opt',
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
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('mac_address',$this->mac_address,true);
		$criteria->compare('hostname',$this->hostname,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('line_manager',$this->line_manager,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('hall',$this->hall,true);
		$criteria->compare('opt',$this->opt,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
	
    /**
     * Enabling Search option based on hostname
     *
     */
    public function searchByEmpID($emp_id){
        return $this->count('emp_id=:emp_id', array(':emp_id' => $emp_id));
    }
	
    public function searchByHostName($hostname){
        return $this->count('hostname=:hostname', array(':hostname' => $hostname));
    }
	
    public function searchByHostNameEmpID($emp_id, $hostname){
        return $this->count('emp_id=:emp_id AND hostname=:hostname', array(':emp_id'=>$emp_id, ':hostname'=>$hostname));
    }
}
