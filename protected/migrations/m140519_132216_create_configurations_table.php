<?php

class m140519_132216_create_configurations_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('configurations', array(
            'id' => 'pk',
            'title' => 'varchar (75) NOT NULL',
            'from_name' => 'varchar (75) NOT NULL',
			'from_email' => 'varchar (75) NOT NULL',
			'bcc' => 'varchar (75) NOT NULL',
        	'notify_email' => 'varchar (75) NOT NULL',
			'records_per_page' => 'int(5) DEFAULT NULL',
			'created' => 'datetime DEFAULT NULL',
			'created_by'=>'int(11) DEFAULT NULL',
			'modified'=>'datetime DEFAULT NULL',
			'modified_by'=>'int(11) DEFAULT NULL',
			
		));
	}

	public function down()
	{
		$this->dropTable('configurations');
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