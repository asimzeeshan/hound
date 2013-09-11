<?php
class EmployeesCommand extends CConsoleCommand {
	public function getHelp() {
		echo "Get all Employees from NextHRM and Populate database";
	}
	
	public function run($args) {
		$NextHRM = $this->_getNextHRMData();
		if ((string)$NextHRM->getSittingDetail->status == "success") {
			$data = json_decode($NextHRM->getSittingDetail->response, true);
			foreach ($data as $record) {
				print_r($record);
				$this->_replaceRecord($record);
			}
		} else {
			echo "Server says bobo, the actual message is: ".(string)$NextHRM->getSitting->status;
		}
		exit;

	}
	
	private function _getNextHRMData() {
		return simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=ace0081960cdefbd537ae5689f63a3bd&method=getSittingDetail&userName=noc@nexthrm.com');
	}
	
	private function _replaceRecord($data) {
		echo "Executing _replaceRecord();\n";
		echo " EmpID: ".$data['emp_id']." \n";
		$chk = new Employees;
		if ($chk->countByEmpID((int)$data['emp_id'])==0) { 
			echo " ".$chk->countByEmpID((int)$data['emp_id'])." employee found so ADDING NEW RECORD \n";

			$employee = new Employees;
			$employee->name 		= $data['emp_name'];
			$employee->email 		= $data['emp_company_email'];
			$employee->joining_date = $data['emp_joining_date'];
			$employee->location		= $data['emp_location'];
			$employee->hall			= $data['emp_hall'];
			$manager1_id = $this->_getManagerID((string)$data['emp_manager_name'], (string)$data['emp_manager_email']);
			if (!empty($manager1_id))
				$employee->manager1_id	= $manager1_id;
				
			$manager2_id = $this->_getManagerID((string)$data['emp_manager2_name'], (string)$data['emp_manager2_email']);
			if (!empty($manager2_id))
				$employee->manager2_id	= $manager2_id;
	
			$employee->created		= new CDbExpression('NOW()');
			$employee->created_by	= 1; // added by SysAdmin
			$employee->modified		= new CDbExpression('NOW()');
			$employee->modified_by	= 1; // added by SysAdmin
			$employee->save();
		} else {
			echo " ".$chk->countByEmpID((int)$data['emp_id'])." employee found so UPDATING RECORD \n";

			$employee = Employees::model()->find('emp_id=:emp_id', array(':emp_id' => (int)$data['emp_id']));
			$employee->name 		= $data['emp_name'];
			$employee->email 		= $data['emp_company_email'];
			$employee->joining_date = $data['emp_joining_date'];
			$employee->location		= $data['emp_location'];
			$employee->hall			= $data['emp_hall'];
			$manager1_id = $this->_getManagerID(trim($data['emp_manager_name']), trim($data['emp_manager_email']));
			echo " Received Manager1 ID= ".$manager1_id;
			if (!empty($manager1_id))
				$employee->manager1_id	= $manager1_id;
				
			$manager2_id = $this->_getManagerID(trim($data['emp_manager2_name']), trim($data['emp_manager2_email']));
			echo " Received Manager2 ID= ".$manager2_id;
			if (!empty($manager2_id))
				$employee->manager2_id	= $manager2_id;
	
			$employee->created_by	= 1; // added by SysAdmin
			$employee->modified_by	= 1; // added by SysAdmin
			$employee->save();
		}
		unset($chk);
		unset($employee);
		exit;
	}
	
	private function _getManagerID($name, $email) {
		echo "This is _getManagerID(); \n";
		echo " - Received Name = ".$name."\n";
		echo " - Received Email = ".$email."\n";
		if (!empty($email)) {
			$chk = new Managers;
			if ($chk->countByEmail((string)$email)==0) { 
				echo " Manager found with email $email = ".$chk->countByEmail((string)$email)." ADDING NEW RECORD \n";
				$manager = new Managers;
				$manager->name			= $name;
				$manager->email			= $email;
				$manager->created		= new CDbExpression('NOW()');
				$manager->created_by	= 1; // added by SysAdmin
				$manager->modified_by	= 1; // added by SysAdmin	
				if ($manager->save()) {
					echo "  New Manager Added with id=".$manager->id."\n";
					return $manager->id;
				} else {
					echo "  Manager ID = ".$manager->id;
					return $manager->id;
				}				
			} else {
				echo " Manager found with email $email = ".$chk->countByEmail((string)$email)." UPDATING RECORD \n";
			
				$manager = Managers::model()->find('name=:name', array(':name' => $name));
				$manager->name			= $name;
				$manager->email			= $email;
				$manager->created_by	= 1; // added by SysAdmin
				$manager->modified_by	= 1; // added by SysAdmin	
				if ($manager->save()) {
					echo "  Manager Updated with id=".$manager->id."\n";
					return $manager->id;
				} else {
					echo "  Manager ID = ".$manager->id;
					return $manager->id;
				}
			}
		unset($chk);
		unset($manager);
		} else { // email is empty
			echo " Manager ID is NULL, no email received \n\n";
			return false;
		}
	}
}
?>