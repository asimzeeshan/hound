<?php
class ImportdataCommand extends CConsoleCommand {
	private $log = NULL;

	public function getHelp() {
		echo "Process the NOC XML data from dmz everynight";
	}
	
	public function init() {
		$this->log = LeLogger::getLogger("d4a2b96e-2c51-4428-813b-f63d5573e95f", true, false, LOG_DEBUG);
	}
	
	public function run($args) {
		$this->log->Info("Cron Job Begins");
		$xml = simplexml_load_file('https://dmz.nextbridge.org/5ebe2294ecd0e0f08eab7690d2a6ee69.php');
		$this->log->Info("File downloaded ... https://dmz.nextbridge.org/5ebe2294ecd0e0f08eab7690d2a6ee69.php ");
		foreach ($xml->dhcpd->lan->staticmap as $node) {
			$this->_processNode($node, "lan");
		}
		
		$this->log->Info("==================== Start OPT1 ====================");
		
		foreach ($xml->dhcpd->opt1->staticmap as $node) {
			$this->_processNode($node, "opt1");
		}
		
		$this->log->Info("==================== Start OPT2 ====================");
		
		foreach ($xml->dhcpd->opt2->staticmap as $node) {
			$this->_processNode($node, "opt2");
		}
		
		$this->log->Info("==================== Start OPT3 ====================");
		
		foreach ($xml->dhcpd->opt3->staticmap as $node) {
			$this->_processNode($node, "opt3");
		}
		
		$this->log->Info("==================== Start OPT4 ====================");
		
		foreach ($xml->dhcpd->opt4->staticmap as $node) {
			$this->_processNode($node, "opt4");
		}
		
		$this->log->Info("==================== Start OPTXXXX =================");
		
		foreach ($xml->dhcpd->optxxxx->staticmap as $node) {
			$this->_processNode($node, "optxxxx");
		}

	}
	
	private function _processNode($obj, $opt) {
		$this->log->Debug("Got MAC=".$obj->mac." | HOSTNAME=".$obj->hostname);
		
		$data 			= $this->_parseObject($obj);
		$data['opt'] 	= $opt;

		$this->log->Debug("NOW PROCESSING ... MAC=".$data['mac']." | HOSTNAME=".$data['hostname']);
		$this->_replaceRecord($data);
	}
	
	private function _parseObject($obj) {
		$descr 		= trim($obj->descr);
		$first_dash	= strpos($descr, "-");
		
		// get employee ID
		$emp_id 		= trim(substr($descr,0,$first_dash));
		// if employee ID is NOT 0; then make sure its 5 digits
		if (is_numeric($emp_id)!=1 || empty($emp_id)) {
			$emp_id = '';
		} else {
			$emp_id	= str_pad(trim(substr($descr,0,$first_dash)), 5, "0", STR_PAD_LEFT);
			//$deviceDataAPIresponse = $this->_callNextHRM($emp_id);
			//$deviceDataArray = json_decode($deviceDataAPIresponse->getSitting->response);
		}
		
		// PATCH1: if we dont have a "-" in the string, then dont truncate
		if ($first_dash<>0) {
			$newpos = $first_dash+1;
		} else {
			$newpos = $first_dash;	
		}
		
		// trim the empDescr
		$empDesc = trim(substr($descr,$newpos,strlen($descr)));
		return array(
						'mac'		=> (string)$obj->mac,
						'ipaddr'	=> (string)$obj->ipaddr,
						'hostname'	=> (string)$obj->hostname,
						'descr'		=> $descr,
						'emp_id'	=> $emp_id,
						'name'		=> $empDesc,
					);
	}
	
	private function _replaceRecord($data) {
		$this->log->Debug("This is _replaceRecord();");
		$this->log->Debug("Received MAC=".$data['mac']." | HOSTNAME=".$data['hostname']);
		$chk = new Devices;
		$checkResult = $chk->countBySegMAC($data['mac'], $data['opt']);
		if ($checkResult==0) { 
			$this->log->Debug($checkResult." device found so ADDING NEW RECORD");
			
			$device 				= new Devices;
			$device->emp_id			= $data['emp_id'];
			$device->name			= ($data['name'] != "") ? $data['name'] : "";
			$device->mac_address	= $data['mac'];
			$device->ip_address		= $data['ipaddr'];
			$device->hostname		= $data['hostname'];
			$device->description	= ($data['descr'] != "") ? $data['descr'] : "";
			$device->created		= new CDbExpression('NOW()');
			$device->created_by		= 1;
			$device->modified_by	= 1;
			$device->opt			= ($data['opt'] != "") ? $data['opt'] : "opt";
			$device->hall			= "N/A";
			$device->line_manager	= "N/A";
			$device->location		= "N/A";
	
			if ($device->save()) {
				$this->log->Notice("ADDED MAC=".$data['mac']." / SEGMENT=".$data['opt']." record!");
				return true;
			} else {
				$error = "";
				$error = "Failed ADDING: MAC=".$data['mac']." / SEGMENT=".$data['opt']."\n";
				foreach ($device->getErrors() as $error) {
					$error .= "    => ".$error[0]."\n";	
				}
				$this->log->Error($error);
				return false;
			}
		} else {
			$this->log->Debug($checkResult." device(s) found so UPDATING RECORD");

			$device 				= Devices::model()->find('mac_address=:mac AND opt=:opt', array(':mac'=>$data['mac'], ':opt'=>$data['opt']));
			$device->emp_id			= $data['emp_id'];
			$device->name			= ($data['name'] != "") ? $data['name'] : "";
			$device->mac_address	= $data['mac'];
			$device->ip_address		= $data['ipaddr'];
			$device->hostname		= $data['hostname'];
			$device->description	= ($data['descr'] != "") ? $data['descr'] : "";
			$device->modified_by	= 1;
			$device->opt			= ($data['opt'] != "") ? $data['opt'] : "opt";
	
			if ($device->save()) {
				$this->log->Notice("UPDATED MAC=".$data['mac']." / SEGMENT=".$data['opt']." record!");
				return true;
			} else {
				$error = "";
				$error = "Failed ADDING: MAC=".$data['mac']." / SEGMENT=".$data['opt']."\n";
				foreach ($device->getErrors() as $error) {
					$error .= "    => ".$error[0]."\n";	
				}
				$this->log->Error($error);
				return false;
			}	
		}
	}
	
	private function _addRecord($data) {
		$this->log->Debug("This is _addRecord();");

		$device 				= new Devices;
		$device->emp_id			= $data['emp_id'];
		$device->name			= ($data['name'] != "") ? $data['name'] : "";
		$device->mac_address	= $data['mac'];
		$device->ip_address		= $data['ipaddr'];
		$device->hostname		= $data['hostname'];
		$device->description	= ($data['descr'] != "") ? $data['descr'] : "";
		$device->created		= new CDbExpression('NOW()');
		$device->created_by		= 1;
		$device->modified_by	= 1;
		$device->opt			= ($data['opt'] != "") ? $data['opt'] : "opt";
		$device->hall			= "N/A";
		$device->line_manager	= "N/A";
		$device->location		= "N/A";

		if ($device->save()) {
			$this->log->Notice("Record ".$data['hostname']." added!");
			return true;
		} else {
			$error = "";
			$error = "Failed adding ".$data['hostname']."\n";
			foreach ($device->getErrors() as $error) {
				$error .= "    => ".$error[0]."\n";	
			}
			$this->log->Error($error);
			return false;
		}
	}
	
	private function _callNextHRM($id) {
		return simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=7eedf192b67b0b15dee3491b286babc9&method=getSitting&userName=noc@nexthrm.com&empId='.$id.'&empName=s');
	}
}
?>