<?php

class m140609_195822_remove_c1_lan_records extends CDbMigration
{
        public function up()
        {
                $this->execute("DELETE FROM `devices` WHERE `opt`='c1-lan';");
                echo "All records from C1-LAN are deleted";
        }

        public function down()
        {
                echo "m140609_195822_remove_c1_lan_records does not support migration down.\n";
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
