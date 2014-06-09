<?php

class m140609_122007_insert_configurations extends CDbMigration
{
	public function up()
	{
		$this->insert('configurations',array(
		 'id'=>'1',
         'title'=>'Abuse Reporter',
         'from_name' =>'Abuse Reporter',
		 'from_email' =>'noc@nxvt.com',
		 'bcc' =>'asim.sarwar@nxb.com.pk',
		 'notify_email' =>'mis@nxb.com.pk',
		 'records_per_page' =>'10',
		 'created_by'=>'1',
		 
  		));
	}

	public function down()
	{
		echo "m140609_122007_insert_configurations does not support migration down.\n";
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