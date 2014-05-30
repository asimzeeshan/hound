<?php
class AZActiveRecord extends CActiveRecord {
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'CreatedBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'ModifiedBy' => array(self::BELONGS_TO, 'Users', 'modified_by'),
		);
	}

	/**
	 * @return array beforeValidate
	 */	
    protected function beforeValidate() {
		if ($this->isNewRecord) {
			$this->created 		= new CDbExpression('NOW()');
			$this->created_by 	= (!isset($this->created_by)) ? Yii::app()->user->id : 1;
			$this->modified_by 	= (!isset($this->modified_by)) ? Yii::app()->user->id : 1;
		}
		if($this->getScenario() != 'not_update'){
			$this->modified 	= new CDbExpression('NOW()');
			//$this->modified_by 	= (!isset($this->modified_by)) ? Yii::app()->user->id : 1;
		}
		return parent::beforeValidate();
    }
		
	
	/**
	 * @return array afterFind
	 */
	protected function afterFind() {
		foreach($this->metadata->tableSchema->columns as $columnName => $column) {           
			if (!strlen($this->$columnName)) continue;
	 
			if ($column->dbType == 'date') { 
				$this->$columnName = Yii::app()->dateFormatter->formatDateTime(
						CDateTimeParser::parse(
							$this->$columnName, 
							'yyyy-MM-dd'
						),
						'medium',null
					);
			} elseif ($column->dbType == 'datetime' || $column->dbType == 'timestamp') {
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
?>
