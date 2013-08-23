<?php
class NexthrmCommand extends CConsoleCommand {
	public function getHelp() {
		echo "Process the NOC XML data from dmz everynight";
	}
	
	public function run($args) {
		$employees = Employees::model()->findAll(array('condition'=>'emp_id!=""'));


	}
	
	private function _callNextHRM($id) {
		return simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=7eedf192b67b0b15dee3491b286babc9&method=getSitting&userName=noc@nexthrm.com&empId='.$id.'&empName=s');
	}
}
?>