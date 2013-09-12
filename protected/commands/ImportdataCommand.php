<?php
class ImportdataCommand extends CConsoleCommand {
	public function getHelp() {
		echo "Process the NOC XML data from dmz everynight";
	}
	
	public function run($args) {
		echo "Cron Job Begins \n";
		$xml = simplexml_load_file('https://dmz.nextbridge.org/5ebe2294ecd0e0f08eab7690d2a6ee69.php');
		echo "File downloaded ... \n";
		foreach ($xml->dhcpd->lan->staticmap as $node) {
			$this->_processNode($node, "lan");
		}
		
		echo "==================== Start OPT1 ====================\n\n";
		
		foreach ($xml->dhcpd->opt1->staticmap as $node) {
			$this->_processNode($node, "opt1");
		}
		
		echo "==================== Start OPT2 ====================\n\n";
		
		foreach ($xml->dhcpd->opt2->staticmap as $node) {
			$this->_processNode($node, "opt2");
		}
		
		echo "==================== Start OPT3 ====================\n\n";
		
		foreach ($xml->dhcpd->opt3->staticmap as $node) {
			$this->_processNode($node, "opt3");
		}
		
		echo "==================== Start OPT4 ====================\n\n";
		
		foreach ($xml->dhcpd->opt4->staticmap as $node) {
			$this->_processNode($node, "opt4");
		}
		
		echo "==================== Start OPTXXXX ====================\n\n";
		
		foreach ($xml->dhcpd->optxxxx->staticmap as $node) {
			$this->_processNode($node, "optxxxx");
		}

	}
	
	private function _processNode($obj, $opt) {
		echo "- Found ".$obj->ipaddr." having MAC ".$obj->mac." and the hostname is ".$obj->hostname." \n";
		
		$data 			= $this->_parseObject($obj);
		$data['opt'] 	= $opt;

		echo "  NOW PROCESSING ... MAC=".$data['mac']." | HOSTNAME=".$data['hostname']." \n";
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
		echo "   This is _replaceRecord(); \n";
		echo "   - Received MAC=".$data['mac']." | HOSTNAME=".$data['hostname']." \n";
		$chk = new Devices;
		$checkResult = $chk->countBySegMAC($data['mac'], $data['opt']);
		if ($checkResult==0) { 
			echo " ".$checkResult." device found so ADDING NEW RECORD \n\n";
			
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
				echo "   - ADDED MAC=".$data['mac']." / SEGMENT=".$data['opt']." record! \n";
				return true;
			} else {
				echo "   - WARNING: Failed ADDING: MAC=".$data['mac']." / SEGMENT=".$data['opt']."\n";
				foreach ($device->getErrors() as $error) {
					echo "     => ".$error[0]."\n";	
				}
				echo "\n";
				return false;
			}
		} else {
			echo " ".$checkResult." device(s) found so UPDATING RECORD \n\n";

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
				echo "   - UPDATED MAC=".$data['mac']." / SEGMENT=".$data['opt']." record! \n";
				return true;
			} else {
				echo "   - WARNING: Failed UPDATING: MAC=".$data['mac']." / SEGMENT=".$data['opt']." \n";
				foreach ($device->getErrors() as $error) {
					echo "     => ".$error[0]."\n";	
				}
				echo "\n";
				return false;
			}	
		}
		echo "\n\n";


	}
	
	private function _addRecord($data) {
		echo "   This is _addRecord(); \n";

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
			echo "   - Record ".$data['hostname']." added! \n";
			return true;
		} else {
			echo "   - WARNING: Failed adding ".$data['hostname']."\n";
			foreach ($device->getErrors() as $error) {
				echo "     => ".$error[0]."\n";	
			}
			echo "\n";
			return false;
		}
	}
	
	private function _callNextHRM($id) {
		return simplexml_load_file('http://nexthrm.vteamslabs.com/web-service/?auth=7eedf192b67b0b15dee3491b286babc9&method=getSitting&userName=noc@nexthrm.com&empId='.$id.'&empName=s');
	}
}
?>