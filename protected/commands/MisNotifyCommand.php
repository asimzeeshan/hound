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
			
			
		$current_date = date('Y-m-d');
		$subject = "Today's Import Report [".$current_date."].";
		$body = $new;
		// send welcome email
				$et = new EmailTemplates;
				$data = $et->getData(8);
				
				// parse Body
				$search = array('{Manager_Name}', '{Employee_List_Table}');
				$replace = array("Mis Manger", $body);
				$body = str_ireplace($search, $replace, $data->body);
				// ends parse Body

				$to = array("danish.na@nxvt.com", "asim.sarwar@nxb.com.pk","asim@nxvt.com");
				$email_data = array(
					'body'=> $body,
					'address'=> $to,
					'ccaddress'=> '',
					'bccaddress'=> '',
					'subject' => $data->subject
				);

				// send the email
				Controller::sendMail($email_data);
	}	
}
?>