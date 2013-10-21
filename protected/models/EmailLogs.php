<?php

/**
 * This is the model class for table "email_logs".
 *
 * The followings are the available columns in table 'email_logs':
 * @property integer $id
 * @property integer $template_id
 * @property string $email_to
 * @property string $email_cc
 * @property string $subject
 * @property string $body
 * @property string $user_id
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 */
class EmailLogs extends AZActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('template_id, email_to, subject, body, user_id, created, created_by, modified, modified_by', 'required'),
			array('template_id', 'numerical', 'integerOnly'=>true),
			array('email_to, email_cc, subject', 'length', 'max'=>255),
			array('user_id, created_by, modified_by', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, template_id, email_to, email_cc, subject, body, user_id, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
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
			'User' => array(self::BELONGS_TO, 'Users', 'user_id'),
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
			'template_id' => 'Template',
			'email_to' => 'TO',
			'email_cc' => 'CC',
			'subject' => 'Subject',
			'body' => 'Body',
			'user_id' => 'Sent By',
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
		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('email_to',$this->email_to,true);
		$criteria->compare('email_cc',$this->email_cc,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('user_id',$this->user_id,true);
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
	 * @return EmailLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
