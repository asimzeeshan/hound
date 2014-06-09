<?php

class m140513_082024_create_changecolumnname_in_devices_table extends CDbMigration
{
	public function up()
	{
		   Yii::app()->db->createCommand('alter table devices change checked last_checked Tinyint (1) ;')->execute();
	}

	public function down()
	{
		$this->dropTable('devices');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}