<?php
class EmployeesCommand extends CConsoleCommand {
	public function getHelp() {
		echo "Get all Employees from NextHRM and Populate database";
	}
	
	public function run($args) {
		print_r($this->_getNextHRMData());exit;
		$employees = Employees::model()->findAll(array('condition'=>'emp_id!=""'));
		foreach ($employees as $employee) {
			$NextHRM = $this->_callNextHRM($employee->emp_id);
			if ((string)$NextHRM->getSitting->status == "success") {
				$data = json_decode($NextHRM->getSitting->response);
				foreach ($data as $record) {
					$this->_updateRecord($employee->emp_id, $record);
				}
			} else {
				echo "Server says bobo, the actual message is: ".(string)$NextHRM->getSitting->status;
			}
		// sleep for 1 second
		sleep(1);
		}

	}
	
	private function _getNextHRMData() {
		return simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=ace0081960cdefbd537ae5689f63a3bd&method=getSittingDetail&userName=noc@nexthrm.com');
	}
	
	private function _updateRecord($emp_id, $data) {
		Devices::model()->updateAll(array(
											'modified_by'	=> 1, 
											'hall'			=> (string)$data->emp_hall, 
											'line_manager'	=> (string)$data->emp_manager_name, 
											'location'		=> (string)$data->emp_location, 
										), 'emp_id=:emp_id', array(':emp_id' => $emp_id));
		echo "Updated all records for EmpID: ".$emp_id." successfully! \n";
	}
}
?>