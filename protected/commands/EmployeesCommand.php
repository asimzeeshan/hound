<?php
class EmployeesCommand extends CConsoleCommand {
	private $log = NULL;

	public function getHelp() {
		echo "Get all Employees from NextHRM and Populate database";
	}
	
	public function init() {
		$this->log = LeLogger::getLogger("70ccf57c-144c-4221-9723-b197de86bd88", true, false, LOG_DEBUG);
	}
	
	public function run($args) {
		$NextHRM = $this->_getNextHRMData();
		if ((string)$NextHRM->getSittingDetail->status == "success") {
			$data = json_decode($NextHRM->getSittingDetail->response, true);
			foreach ($data as $record) {
				$this->log->Debug("==================== EmpID: ".$record['emp_id']." ====================\n");
				$this->log->Debug(print_r($record, true));
				$this->_replaceRecord($record);
			}
		} else {
			$this->log->Emerg("Server says bobo, the actual message is: ".(string)$NextHRM->getSitting->status);
		}
		exit;

	}
	
	private function _getNextHRMData() {
		return simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=ace0081960cdefbd537ae5689f63a3bd&method=getSittingDetail&userName=noc@nexthrm.com');
	}
	
	private function _replaceRecord($data) {
		$this->log->Info("Executing _replaceRecord();");
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
			$this->log->Warn("WARNING! The user '".$data['emp_name']."' having EmpID=".$data['emp_id']." has no 'Company Email'");
		}
		
		if ($chk->countByEmpID((int)$data['emp_id'])==0) { 
			$this->log->Info($chk->countByEmpID((int)$data['emp_id'])." employee found so ADDING NEW RECORD");

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
				$this->log->Info("ADDED EMPID=".$data['emp_id']." record!");
				return true;
			} else {
				$error = "";
				$error = "Failed ADDING: EMPID=".$data['emp_id']."\n";
				foreach ($employee->getErrors() as $error) {
					$error .= "    => ".$error[0]."\n";	
				}
				$this->log->Error($error);
				return false;
			}
		} else {
			$this->log->Info($chk->countByEmpID((int)$data['emp_id'])." employee found so UPDATING RECORD");

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
				$this->log->Info("UPDATED EMPID=".$data['emp_id']." record!");
				return true;
			} else {
				$error = "";
				$error = "Failed ADDING: EMPID=".$data['emp_id']."\n";
				foreach ($employee->getErrors() as $error) {
					$error .= "    => ".$error[0]."\n";	
				}
				$this->log->Error($error);
				return false;
			}
		}
		unset($chk);
		unset($manager1_id);
		unset($manager2_id);
		unset($employee);
	}
	
	private function _getManagerID($name, $email) {
		$this->log->Info("This is _getManagerID();");
		if (!empty($email)) {
			$chk = new Managers;
			if ($chk->countByEmail((string)$email)==0) { 
				$this->log->Debug("Manager found with email '$email' = ".$chk->countByEmail((string)$email)." ADDING NEW RECORD");
				$manager = new Managers;
				$manager->name			= $name;
				$manager->email			= $email;
				$manager->created		= new CDbExpression('NOW()');
				$manager->created_by	= 1; // added by SysAdmin
				$manager->modified_by	= 1; // added by SysAdmin	
				if ($manager->save()) {
					$this->log->Debug(" - New Manager Added with id=".$manager->id);
					return $manager->id;
				} else {
					$this->log->Debug(" - Manager ID = ".$manager->id);
					return $manager->id;
				}				
			} else {
				$this->log->Debug("Manager found with email '$email' = ".$chk->countByEmail((string)$email)." UPDATING RECORD");
				$manager = Managers::model()->find('name=:name', array(':name' => $name));
				$manager->name			= $name;
				$manager->email			= $email;
				$manager->created_by	= 1; // added by SysAdmin
				$manager->modified_by	= 1; // added by SysAdmin	
				if ($manager->save()) {
					$this->log->Debug(" - Manager Updated with id=".$manager->id);
					return $manager->id;
				} else {
					$this->log->Debug(" - Manager ID = ".$manager->id);
					return $manager->id;
				}
			}
		unset($chk);
		unset($manager1_id);
		unset($manager2_id);
		unset($manager);
		} else { // email is empty
			$this->log->Warn(" * WARNING! Manager ID is NULL because no email received \n");
			return false;
		}
	}
}
?>