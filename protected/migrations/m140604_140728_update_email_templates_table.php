<?php

class m140604_140728_update_email_templates_table extends CDbMigration
{
	public function up()
	{
		$this->update('email_templates', array('created_by'=> 1,'modified_by'=>1));
	}

	public function down()
	{
		echo "m140604_140728_update_email_templates_table does not support migration down.\n";
		return false;
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