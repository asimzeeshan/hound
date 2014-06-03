<?php
class MisNotifyCommand extends CConsoleCommand {

	private $log;

	public function getHelp(){
		echo "Process the MIS Devices Report.";
	}
	
	public function init(){
		//$this->log = new LoggingWrapper;
		$this->log = NULL;
	}
	// this function is used for display all records where mis_notify field is 1...
	private function _misRecord(){
		$criteria = new CDbCriteria();
		$criteria->condition = "mis_notify = '1'";
		$criteria->select = "name, mac_address, ip_address, hostname, opt";
		$Devices = Devices::model()->findAll($criteria);		
		return $Devices;
	}
	
	// this function is used to dispaly all records...
	public function run(){
		$misRecord = $this->_misRecord();
		$new = "<br /> <br />
		 <table border=1 width='95%'>
			  <th width='45%'> Name</th>
			  <th width='16%'>Mac</th>
			  <th width='16%'>Ipaddar</th>
			  <th width='16%'>Hostname</th>
			  <th width='16%'>Opt</th>  ";
		           foreach($misRecord as $query){
					   
			      $new .= "<tr><td align='center'>".$query->name."</td>
					      <td align='center'>". $query->mac_address."</td>
					      <td align='center'>". $query->ip_address."</td>
					      <td align='center'>". $query->hostname."</td>
						  <td align='center'>". $query->opt."</td></tr>";
				}
				   $new .= "</table>
				  <br /><br /><br />
				  ";
			
			
		$current_date = date('Y-m-d');
		$subject = "Today's Import Devices Report [".$current_date."].";
		$body = $new;
		// send welcome email
				$et = new EmailTemplates;
				$data = $et->getData(8);
				$model_configurations = new Configurations;
				$mis_email = $model_configurations->applicationsEmail();
				$mis_email = $mis_email[0]['notify_email'];
				// parse Body
				$search = array('{Manager_Name}', '{Employee_List_Table}');
				$replace = array("MIS Manger", $body);
				$body = str_ireplace($search, $replace, $data->body);
				// ends parse Body

				$to = array($mis_email);
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