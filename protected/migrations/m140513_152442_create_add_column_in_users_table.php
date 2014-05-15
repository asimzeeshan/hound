<?php

class m140513_152442_create_add_column_in_users_table extends CDbMigration
{
	
	public function up()
	{
		 $this->addColumn('users', 'roles',  "varchar(30) NOT NULL AFTER status");
		
	}

	public function down()
	{
		$this->dropTable('users');
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