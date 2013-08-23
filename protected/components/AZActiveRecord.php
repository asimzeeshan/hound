<?php

class AZActiveRecord extends CActiveRecord {

	/**
	 * @return array beforeValidate
	 */	
    protected function beforeValidate() {
		if ($this->isNewRecord) {
			$this->created 		= new CDbExpression('NOW()');
			$this->created_by 	= Yii::app()->user->name;
		}
		
		$this->modified 	= new CDbExpression('NOW()');
		$this->modified_by 	= Yii::app()->user->name;

		return parent::beforeValidate();
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
