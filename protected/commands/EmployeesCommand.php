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
				$this->_log("==================== EmpID: ".$record['emp_id']." ====================\n", "debug");
				$this->_log($record, "debug");
				$this->_replaceRecord($record);
			}
		} else {
			$this->_log("Server says bobo, the actual message is: ".(string)$NextHRM->getSitting->status, "Emerg");
		}
		exit;

	}
	
	private function _getNextHRMData() {
		return simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=ace0081960cdefbd537ae5689f63a3bd&method=getSittingDetail&userName=noc@nexthrm.com');
	}
	
	private function _replaceRecord($data) {
		$this->_log("Executing _replaceRecord();\n");
		$chk = new Employees;
		
		if (trim($data['emp_company_email'])=="") {
			/*$body = "Team,<br /><br />

					{emp_id} has missing email data, NextHRM said
					
					<p><pre>{nexthrm_dump}</pre></p>
					
					<p><strong>Note:</strong> The system us using noreply@nxb.com.pk instead, for the time being.</p>";
			
			// parse Body
			$search = array('{emp_id}', '{nexthrm_dump}');
			$replace = array($data['emp_id'], print_r($data, true));
			$body = str_ireplace($search, $replace, $body);
			// ends parse Body
			
			$mail             = new PHPMailer();
			$body             = str_replace("[\]",'',$body);
			$mail->AddReplyTo('noc@nxvt.com', 'NOC Team');
			$mail->SetFrom('noreply@projectx.vteamslabs.com', 'ProjectX');
			$mail->AddAddress('noc@nxvt.com', 'NOC Team');
			$mail->Subject    = "[Reportr] Missing 'Company Email' for EmpID=".$data['emp_id']."";
			$mail->MsgHTML($body);

			//$mail->AddAttachment("images/phpmailer.gif");      // attachment

			if(!$mail->Send()) {
				echo "WARNING! EMAIL SENDING Failed: " . $mail->ErrorInfo;
			} else {
				echo "EMAIL sent!";
			}*/
			$this->_log(" WARNING! The user '".$data['emp_name']."' having EmpID=".$data['emp_id']." has no 'Company Email' \n", "warning");
		}
		
		if ($chk->countByEmpID((int)$data['emp_id'])==0) { 
			$this->_log(" ".$chk->countByEmpID((int)$data['emp_id'])." employee found so ADDING NEW RECORD \n\n");

			$employee = new Employees;
			$employee->emp_id 		= $data['emp_id'];
			$employee->name 		= $data['emp_name'];
			$employee->email 		= ($data['emp_company_email'] != "") ? $data['emp_company_email'] : "noreply@nxb.com.pk";
			$employee->joining_date = $data['emp_joining_date'];
			$employee->location		= ($data['emp_location'] != "") ? $data['emp_location'] : "N/A";
			$employee->hall			= ($data['emp_hall'] != "") ? $data['emp_hall'] : "N/A";
			$manager1_id = $this->_getManagerID(trim($data['emp_manager_name']), trim($data['emp_manager_email']));
			if (!empty($manager1_id))
				$employee->manager1_id	= $manager1_id;
				
			$manager2_id = $this->_getManagerID(trim($data['emp_manager2_name']), trim($data['emp_manager2_email']));
			if (!empty($manager2_id))
				$employee->manager2_id	= $manager2_id;
	
			$employee->created		= new CDbExpression('NOW()');
			$employee->created_by	= 1; // added by SysAdmin
			$employee->modified		= new CDbExpression('NOW()');
			$employee->modified_by	= 1; // added by SysAdmin
			if ($employee->save()) {
				$this->_log(" - ADDED EMPID=".$data['emp_id']." record! \n");
				return true;
			} else {
				$this->_log(" - Failed ADDING: EMPID=".$data['emp_id']." \n", "error");
				foreach ($employee->getErrors() as $error) {
					$this->_log("   => ".$error[0]."\n", "error");	
				}
				return false;
			}
		} else {
			$this->_log(" ".$chk->countByEmpID((int)$data['emp_id'])." employee found so UPDATING RECORD \n\n");

			$employee = Employees::model()->find('emp_id=:emp_id', array(':emp_id' => (int)$data['emp_id']));
			$employee->name 		= $data['emp_name'];
			$employee->email 		= $data['emp_company_email'];
			$employee->joining_date = $data['emp_joining_date'];
			$employee->location		= $data['emp_location'];
			$employee->hall			= $data['emp_hall'];
			$manager1_id = $this->_getManagerID(trim($data['emp_manager_name']), trim($data['emp_manager_email']));
			if (!empty($manager1_id))
				$employee->manager1_id	= $manager1_id;
				
			$manager2_id = $this->_getManagerID(trim($data['emp_manager2_name']), trim($data['emp_manager2_email']));
			if (!empty($manager2_id))
				$employee->manager2_id	= $manager2_id;
	
			$employee->created_by	= 1; // added by SysAdmin
			$employee->modified_by	= 1; // added by SysAdmin
			if ($employee->save()) {
				$this->_log(" UPDATED EMPID=".$data['emp_id']." record! \n");
				return true;
			} else {
				$this->_log(" Failed UPDATING EMPID=".$data['emp_id']." \n", "warning");
				foreach ($employee->getErrors() as $error) {
					$this->_log( "    => ".$error[0]."\n", "warning");	
				}
				return false;
			}
		}
		unset($chk);
		unset($manager1_id);
		unset($manager2_id);
		unset($employee);
	}
	
	private function _getManagerID($name, $email) {
		$this->_log(" - This is _getManagerID(); \n", "debug");
		if (!empty($email)) {
			$chk = new Managers;
			if ($chk->countByEmail((string)$email)==0) { 
				$this->_log("  - Manager found with email '$email' = ".$chk->countByEmail((string)$email)." ADDING NEW RECORD \n", "debug");
				$manager = new Managers;
				$manager->name			= $name;
				$manager->email			= $email;
				$manager->created		= new CDbExpression('NOW()');
				$manager->created_by	= 1; // added by SysAdmin
				$manager->modified_by	= 1; // added by SysAdmin	
				if ($manager->save()) {
					$this->_log("  * New Manager Added with id=".$manager->id."\n", "debug");
					return $manager->id;
				} else {
					$this->_log("  * Manager ID = ".$manager->id, "debug");
					return $manager->id;
				}				
			} else {
				$this->_log("  - Manager found with email '$email' = ".$chk->countByEmail((string)$email)." UPDATING RECORD \n", "debug");
				$manager = Managers::model()->find('name=:name', array(':name' => $name));
				$manager->name			= $name;
				$manager->email			= $email;
				$manager->created_by	= 1; // added by SysAdmin
				$manager->modified_by	= 1; // added by SysAdmin	
				if ($manager->save()) {
					$this->_log("  * Manager Updated with id=".$manager->id."\n", "debug");
					return $manager->id;
				} else {
					$this->_log("  * Manager ID = ".$manager->id, "debug");
					return $manager->id;
				}
			}
		unset($chk);
		unset($manager1_id);
		unset($manager2_id);
		unset($manager);
		} else { // email is empty
			$this->_log("  * WARNING! Manager ID is NULL because no email received \n", "error");
			return false;
		}
	}
	
	private function _log($string, $type="info") {
		if ($type=="info") {
			// do nothing
		} else {
			echo strtoupper($type).": ";				
		}

		if (is_object($string) || is_array($string)) { // check if its an object
			print_r($string);
		} else {
			echo $string;
		}
	}
}
?>