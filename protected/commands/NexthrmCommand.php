<?php
class NexthrmCommand extends CConsoleCommand {
	public function getHelp() {
		echo "Process the NOC XML data from dmz everynight";
	}
	
	public function run($args) {
		echo "Looking for all devices where emp_id is not NULL \n";
		$devices = Devices::model()->findAll(array('condition'=>'emp_id!=""'));
		foreach ($devices as $device) {
			$NextHRM = $this->_callNextHRM($device->emp_id);
			if ((string)$NextHRM->getSitting->status == "success") {
				$data = json_decode($NextHRM->getSitting->response);
				foreach ($data as $record) {
					$this->_updateRecord($device->emp_id, $record);
				}
			} else {
				echo "   => Server says bobo, the actual message is: ".(string)$NextHRM->getSitting->status." \n\n";
			}
		// usleep for 200 ms
		usleep(200);
		}

	}
	
	private function _callNextHRM($id) {
		return simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=7eedf192b67b0b15dee3491b286babc9&method=getSitting&userName=noc@nexthrm.com&empId='.$id.'&empName=s');
	}
	
	private function _updateRecord($emp_id, $data) {
		Devices::model()->updateAll(array(
											'modified_by'	=> 1, 
											'hall'			=> (string)$data->emp_hall, 
											'line_manager'	=> (string)$data->emp_manager_name, 
											'location'		=> (string)$data->emp_location, 
										), 'emp_id=:emp_id', array(':emp_id' => $emp_id));
		echo " * Updated all records for EmpID: ".$emp_id." successfully! \n\n ";
	}
}
?>