<?php

class m140609_073931_insert_newEmailTemplates_ForRestPassword_inEmailTemplated_table extends CDbMigration
{
	public function up()
	{
		$this->insert('email_Templates',array(
		 'id'=>'9',
         'title'=>'Abuse Reporter',
         'subject' =>'Your Password has been rest',
         'body' => '<p>{NAME},</p>
                    <p>Someone from the adminstrator has changed your password for Abuse Reporter. Kindly note your new credentials.</p>
					<p><strong>User Name:</strong> {username}<br /> <strong>Password:</strong> {password} <br /> <strong>URL:</strong> <a href="http://ardev.be.vteamslabs.com/">					           			http://ardev.be.vteamslabs.com/ </a></p>
					<p><strong>Note:</strong> Use it responsibly, all actions are being logged once you are in <em>ProjectX</em></p>
					<p>--</p>
					<p><img src="http://asim.vteamslabs.com/asim.jpg" alt="Asim Zeeshan" width="610" height="170" /></p>',
  		));
	}

	public function down()
	{
		echo "m140609_073931_insert_newEmailTemplates_ForRestPassword_inEmailTemplated_table does not support migration down.\n";
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