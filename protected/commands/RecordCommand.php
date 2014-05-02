<?php
class RecordCommand extends CConsoleCommand {

	private $log;

	public function getHelp(){
		echo "Process the Device Management.";
	}
	
	public function init(){
		//$this->log = new LoggingWrapper;
		$this->log = NULL;
	}
	// this function is used for display all new records...
	private function _newRecord(){
		$Criteria = new CDbCriteria();
		$today = date('Y-m-d');
		$Criteria->condition = "created = modified AND DATE(created) = '$today' AND DATE(modified) = '$today'";
		$Criteria->select = "name, mac_address, ip_address, hostname ";
		$Devices = Devices::model()->findAll($Criteria);		
		return $Devices;
	}
	
	// this function is used for display all changed records...
	private function _changeRecord(){
		$Criteria = new CDbCriteria();
		$today = date('Y-m-d');
		$Criteria->condition = "created != modified AND DATE(modified) = '$today'";
		$Criteria->select = "name, mac_address, ip_address, hostname";
		$Devices = Devices::model()->findAll($Criteria);			
		return $Devices;
	}
	
	// this function is used for display all deleted records...
	private function _deleteRecord(){
		$Devices = Devices::model()->updateAll(array("deleted"=>1),"DATEDIFF(NOW(),modified)>= 2");	
		$Criteria = new CDbCriteria();
		$Criteria->condition = "deleted = 1";
		$Criteria->select = "name, mac_address, ip_address, hostname";
		$Devices = Devices::model()->findAll($Criteria);
		return ($Devices);
	}
	// this function is used to dispaly all records...
	public function run(){
		$newRecord = $this->_newRecord();
		$new = "New Records are\n;
		 <table border=1 width='50%'>
			  <th> Name</th>
			  <th>Mac</th>
			  <th>Ipaddar</th>
			  <th>Hostname</th>  ";
		           foreach($newRecord as $query){
					   
			      $new .= "<tr><td align='center'>".$query['name']."</td>
					      <td align='center'>". $query['mac_address']."</td>
					      <td align='center'>". $query['ip_address']."</td>
					      <td align='center'>". $query['hostname']."</td></tr>";
				}
				   $new .= "</table>";
				   //echo $new;
		$changeRecord = $this->_changeRecord();
		$change = "Changed Records are\n;
		 <table border=1 width='50%'>
			  <th> Name</th>
			  <th>Mac</th>
			  <th>Ipaddar</th>
			  <th>Hostname</th>  ";
		           foreach($changeRecord as $query){
					   
			       $change .= "<tr><td align='center'>".$query['name']."</td>
					      <td align='center'>". $query['mac_address']."</td>
					      <td align='center'>". $query['ip_address']."</td>
					      <td align='center'>". $query['hostname']."</td></tr>";
				}
				   $change .= "</table>";
				   //echo $change;
		$deleteRecord = $this->_deleteRecord();
		$delete = "Deleted Records are\n;
		 <table border=1 width='50%'>
			  <th> Name</th>
			  <th>Mac</th>
			  <th>Ipaddar</th>
			  <th>Hostname</th>  ";
		           foreach($deleteRecord as $query){
					   
			       $delete .= "<tr><td align='center'>".$query['name']."</td>
					      <td align='center'>". $query['mac_address']."</td>
					      <td align='center'>". $query['ip_address']."</td>
					      <td align='center'>". $query['hostname']."</td></tr>";
				}
				  $delete .= "</table>";
				   //echo $delete;		   		   
		$fp = fopen('D:/test1.html', 'w') or die('error creating file');
		fwrite($fp,$new) or die('error writing file');
		fwrite($fp, $change)  or die('error writing file');
		fwrite($fp,  $delete)  or die('error writing file');
		fclose($fp);
		exit();
		$parse_subject = "Today's Import Report [05-02-2014].";
		$parse_body = array($new, $change, $delete);
		$record_data = array(
					'subject'	=> $parsed_subject,
					'body'		=> $parsed_body,				
				);
		$parentController = new	Controller();
		$parentController->sendMail($record_data);
	}	
}
?>