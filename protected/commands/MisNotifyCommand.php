<?php
class MisNotifyCommand extends CConsoleCommand {

	private $log;

	public function getHelp(){
		echo "Process the Device Management.";
	}
	
	public function init(){
		//$this->log = new LoggingWrapper;
		$this->log = NULL;
	}
	// this function is used for display all records where mis_notify field is 1...
	private function _misRecord(){
		$criteria = new CDbCriteria();
		$criteria->condition = "mis_notify = '1'";
		$criteria->select = "name, mac_address, ip_address, hostname ";
		$Devices = Devices::model()->findAll($criteria);		
		return $Devices;
	}
	
	// this function is used to dispaly all records...
	public function run(){
		$misRecord = $this->_misRecord();
		$new = "<strong>Mis Records:</strong><br /> <br />
		 <table border=1 width='95%'>
			  <th width='45%'> Name</th>
			  <th width='16%'>Mac</th>
			  <th width='16%'>Ipaddar</th>
			  <th width='16%'>Hostname</th>  ";
		           foreach($misRecord as $query){
					   
			      $new .= "<tr><td align='center'>".$query->name."</td>
					      <td align='center'>". $query->mac_address."</td>
					      <td align='center'>". $query->ip_address."</td>
					      <td align='center'>". $query->hostname."</td></tr>";
				}
				   $new .= "</table>
				  <br /><br /><br />
				  ";
				  echo $new;
			$footer = '<div dir="ltr"><span style="font-family:courier new,monospace"><span style="color:rgb(153,153,153)"><span style="font-size:11px">Kind regards,<br>
        <br><b>Noc Team</b><br>
        <b>Nextbridge Pvt ltd.</b><br>
        <br>
        Let’s connect.<br>Call me @ +9xx-xxx-xxxx-6<br>
        Skype me @ asim.vteams<br>
        email us @ <a target="_blank" href="mailto:noc@nxvt.com">noc@nxvt.com</a><b><br></b>Web @ <a target="_blank" href="http://www.nextbridge.pk">http://www.nextbridge.pk</a> <b><br></b></span></span></span></div>';	  
		$current_date = date('Y-m-d');
		$subject = "Today's Import Report [".$current_date."].";
		$body = $new.$footer;
		$to = $cc = $bcc = array();
		$to = array("danish.na@nxvt.com", "asim.sarwar@nxb.com.pk","asim@nxvt.com");
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