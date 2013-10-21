<?php

/**
 * This is the model class for table "managers".
 *
 * The followings are the available columns in table 'managers':
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 *
 * The followings are the available model relations:
 * @property Employees[] $employees
 * @property Employees[] $employees1
 */
class Managers extends AZActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'managers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, created, created_by, modified, modified_by', 'required'),
			array('name, email', 'length', 'max'=>255),
			array('created_by, modified_by', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, email, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
			'manager2' => array(self::HAS_MANY, 'Employees', 'manager2_id'),
			'manager1' => array(self::HAS_MANY, 'Employees', 'manager1_id'),
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
			'name' => 'Name',
			'email' => 'Email',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>25,),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Managers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function countByEmail($email){
        return $this->count('email=:email', array(':email' => $email));
    }
	
	// return the name
	public function name() {
		return $this->name;
	}
	
	// return the name and email
	public function details() {
		return $this->name." (".$this->email.")";
	}
}
