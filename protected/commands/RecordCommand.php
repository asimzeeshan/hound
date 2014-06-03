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
		$criteria = new CDbCriteria();
		$today = date('Y-m-d');
		$criteria->condition = "created = modified AND DATE(created) = '$today' AND DATE(modified) = '$today'";
		$criteria->select = "name, mac_address, ip_address, hostname ";
		$Devices = Devices::model()->findAll($criteria);		
		return $Devices;
	}
	
	// this function is used for display all changed records...
	private function _changeRecord(){
		$criteria = new CDbCriteria();
		$today = date('Y-m-d');
		$criteria->condition = "created != modified AND DATE(modified) = '$today'";
		$criteria->select = "name, mac_address, ip_address, hostname";
		$Devices = Devices::model()->findAll($criteria);			
		return $Devices;
	}
	
	// this function is used for display all deleted records...
	private function _deleteRecord(){
		$Devices = Devices::model()->updateAll(array("deleted_flag"=>1),"DATEDIFF(NOW(),last_checked)>= 2");	
		$criteria = new CDbCriteria();
		$criteria->condition = "deleted_flag = 1";
		$criteria->select = "name, mac_address, ip_address, hostname";
		$Devices = Devices::model()->findAll($criteria);
		return ($Devices);
	}
	// this function is used to dispaly all records...
	public function run(){
		$newRecord = $this->_newRecord();
		$new = "<strong>New Records:</strong><br /> <br />
		 <table border=1 width='95%'>
			  <th width='45%'> Name</th>
			  <th width='16%'>Mac</th>
			  <th width='16%'>Ipaddar</th>
			  <th width='16%'>Hostname</th>  ";
		           foreach($newRecord as $query){
					   
			      $new .= "<tr><td align='center'>".$query->name."</td>
					      <td align='center'>". $query->mac_address."</td>
					      <td align='center'>". $query->ip_address."</td>
					      <td align='center'>".$query->hostname."</td></tr>";
				}
				   $new .= "</table>";
		$changeRecord = $this->_changeRecord();
		$change = "<br /><strong>Changed Records</strong>:<br /> <br />
		 <table border=1 width='95%'>
			  <th width='45%'> Name</th>
			  <th width='16%'>Mac</th>
			  <th width='16%'>Ipaddar</th>
			  <th width='16%'>Hostname</th>  ";
		           foreach($changeRecord as $query){
					   
			       $change .= "<tr><td align='center'>".$query->name."</td>
					      <td align='center'>". $query->mac_address."</td>
					      <td align='center'>". $query->ip_address."</td>
					      <td align='center'>".$query->hostname."</td></tr>";
				}
				   $change .= "</table>";
		$deleteRecord = $this->_deleteRecord();
		$delete = "<br/><strong>Deleted Records:</strong><br /> <br />
		 <table border=1 width='95%'>
			 <th width='45%'> Name</th>
			 <th width='16%'>Mac</th>
			  <th width='16%'>Ipaddar</th>
			  <th width='16%'>Hostname</th>  ";
		           foreach($deleteRecord as $query){
					   
			       $delete .= "<tr><td align='center'>".$query->name."</td>
					      <td align='center'>". $query->mac_address."</td>
					      <td align='center'>". $query->ip_address."</td>
					      <td align='center'>".$query->hostname."</td></tr>";
				}
				  $delete .= "</table>  
				  <br /><br /><br />
				  ";
		$model_configurations = new Configurations;
		$noc_email = $model_configurations->applicationsEmail();
		$noc_email = $noc_email[0]['from_email'];
		$footer = '<div dir="ltr"><span style="font-family:courier new,monospace"><span style="color:rgb(153,153,153)"><span style="font-size:11px">Kind regards,<br>
        <br><b>Noc Team</b><br>
        <b>Nextbridge Pvt ltd.</b><br>
        <br>
        Let’s connect.<br>Call me @ +9xx-xxx-xxxx-6<br>
        Skype me @ asim.vteams<br>
        email us @ <a target="_blank" href="mailto:'.$noc_email.'">'.$noc_email.'</a><b><br></b>Web @ <a target="_blank" href="http://www.nextbridge.pk">http://www.nextbridge.pk</a> <b><br></b></span></span></span></div>';	  
		$current_date = date('Y-m-d');
		$subject = "Today's Import Report [".$current_date."].";
		$body = $new. $change.$delete.$footer;
		$to = $cc = $bcc = array();
		$to = array($noc_email);
		$record_data = array(
					'address'	=> $to,
					'ccaddress'	=> $cc,
					'bccaddress'=> $bcc,
					'subject'	=> $subject,
					'body'		=> $body,
					'user_id'	=> 1,
				);
		Controller::sendMail($record_data);
	}	
}
?>