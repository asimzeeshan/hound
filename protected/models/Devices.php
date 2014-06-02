<?php

/**
 * This is the model class for table "devices".
 *
 * The followings are the available columns in table 'devices':
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
class Devices extends AZActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	#public $picture = null; 
	public function tableName()
	{
		return 'devices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, ip_address, mac_address, hostname, description, line_manager, location, hall, opt, created, created_by, modified, modified_by', 'required'),
			array('id', 'length', 'max'=>20),
			array('emp_id, name, ip_address, mac_address, hostname, description, line_manager, location, hall', 'length', 'max'=>255),
			array('opt, deleted_flag, last_checked', 'length', 'max'=>256),
			array('created_by, modified_by', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_id, name, deleted_flag, last_checked, ip_address, mac_address, hostname, description, line_manager, location, hall, opt, mis_notify, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		//$new_relations = array(
			//'_employee' => array(self::HAS_MANY, 'Employees', 'emp_id'),
		//);
		
		$relations = parent::relations();
		//$relations = array_merge($relations, $new_relations);
		return $relations;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'emp_id' => 'Emp',
			'name' => 'Name',
			'ip_address' => 'Ip Address',
			'mac_address' => 'Mac Address',
			'hostname' => 'Hostname',
			'description' => 'Description',
			'line_manager' => 'Line Manager',
			'location' => 'Location',
			'hall' => 'Hall',
			'opt' => 'Opt',
			'deleted_flag'=>'Deleted_Flag',
			'last_checked'=>'Last_Checked',
			'mis_notify'=>'Mis_notify',
			'created' => 'Created',
			'created_by' => 'Created By',
			'modified' => 'Modified',
			'modified_by' => 'Modified By',
			//'picture' => 'Employee Picture',
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
		$criteria->compare('mis_notify',$this->mis_notify,true);
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
	
	public function searchlistWithoutEmpId()
	{
		// this funcion is used for getting the list of  employees whose have no emp_id .
		
		$records_per_page = new CDbCriteria;  // this criteria is used for getting the pagination size from cofigurations table in show record per page according this getting size
		$records_per_page->select = "records_per_page";
		$Configurations = Configurations::model()->find($records_per_page);
		$records_per_page = $Configurations['records_per_page'];
		
		$criteria=new CDbCriteria;
		$criteria->condition = "emp_id = ''";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>$records_per_page),
		));
	}
	
	public function getListWithoutEmpId($checkbox)
	{
		// this funcion is used for return the  marked list of  employees whose have no emp_id .
		    $Criteria = new CDbCriteria();
			$Criteria->addInCondition("id", $checkbox);
			$Criteria->select = "id, name, mac_address, ip_address, hostname, opt ";
			$Devices =Devices:: model()->findAll($Criteria);
			$no_emp_id = "<br /><strong>Employee List without Employee ID </strong>:<br /> <br />
		      <table border=1 width='95%'>
			  <th width='45%'> Name</th>
			  <th width='16%'>Mac</th>
			  <th width='16%'>Ipaddar</th>
			  <th width='16%'>Hostname</th>  ";
		           foreach($Devices as $query){
					$userLink = CHtml::link($query->name,array("devices/update","id"=>$query->id));
			       	$no_emp_id .= "<tr><td align='center'>".$userLink."</td>
					      <td align='center'>". $query->mac_address."</td>
					      <td align='center'>". $query->ip_address."</td>
					      <td align='center'>". $query->hostname."</td>
						  <td align='center'>". $query->opt."</td></tr>";
				}
				   $no_emp_id .= "</table>";
				   return $no_emp_id;
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Devices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Enabling Search option based on hostname
     *
     */
    public function countByEmpID($emp_id){
        return $this->count('emp_id=:emp_id', array(':emp_id' => $emp_id));
    }
	
    public function countByHostName($hostname){
        return $this->count('hostname=:hostname', array(':hostname' => $hostname));
    }
	
    public function countByMAC($mac_address){
        return $this->count('mac_address=:mac_address', array(':mac_address' => $mac_address));
    }
	
    public function countBySegMAC($mac, $opt){
        return $this->count('mac_address=:mac_address AND opt=:opt', array(':mac_address'=>$mac, ':opt'=>$opt));
    }
	
    public function countByHostNameEmpID($emp_id, $hostname){
        return $this->count('emp_id=:emp_id AND hostname=:hostname', array(':emp_id'=>$emp_id, ':hostname'=>$hostname));
    }
	
    public function searchByIp($ipaddress){
		$match = addcslashes($ipaddress, '%_'); // escape LIKE's special characters

		// directly into findAll()
        $ipaddresses = $this->findAll(
            'ip_address LIKE :ip_address',
            array(':ip_address' => "%$match%")
        );
        return $ipaddresses;
    }
	
	public function searchByEmpID($emp_id){
		$emp_id  = addcslashes($emp_id, '%_'); // escape LIKE's special characters

		// directly into findAll()
		$users_details = $this->findAll(
            'emp_id LIKE :emp_id',
            array( ':emp_id' => "%$emp_id%" )
        );
        return $users_details;
    }
	
	/**
	* Returns the Employee image and his/her location image
	*/
	public function getPicture(){
		$criteria = new CDbCriteria();
		$criteria->condition = "emp_id = :EMPID";
		$criteria->params[':EMPID'] = $this->emp_id;
		$criteria->select = "pic,location_pic";
		$empl_pic = Employees::model()->find($criteria);
		return 	$empl_pic;
	}
	
	public function searchBySegMAC($mac, $opt){ // search by MAC in Segment
		if($opt == NULL) {
				$users_details = $this->findAll(
					'mac_address = :mac_address AND opt IS NULL',
					array( ':mac_address' => $mac )
				);
		} else {
				$users_details = $this->findAll(
					'mac_address = :mac_address AND opt = :opt',
					array( ':mac_address' => $mac, ':opt' => $opt )
				);
		}
        return $users_details;
    }
	/**
	* Return the integer which contains total number of devices in db table devices.
	*/
	public function countAllDevices()
	{
		 $criteria = new CDbCriteria();
		 $criteria->select = '*';
		 $devices = Devices::model()->findAll($criteria);
		 return count($devices);
	}
}
