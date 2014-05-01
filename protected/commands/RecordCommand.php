<?php
class RecordCommand extends CConsoleCommand
{
	
	
	public function newRecord()
	{
					
		$Criteria = new CDbCriteria();
		$today = date('Y-m-d');
		//$Criteria->condition = "created = modified And id = 1";
		$Criteria->condition = "created = modified And DATE(created) = '$today' And DATE(modified) = '$today'";
		$Criteria->select = "name, mac_address, ip_address, hostname ";
		$Devices = Devices::model()->findAll($Criteria);			
		//CVarDumper::dump($Products);
		//print_r ($Devices);
		return $Devices;
		
	}
	
	public function changeRecord()
	{
					
		$Criteria = new CDbCriteria();
		$today = date('Y-m-d');
		$Criteria->condition = "created != modified And DATE(modified) = '$today'";
		$Criteria->select = "name, mac_address, ip_address, hostname";
		$Devices = Devices::model()->findAll($Criteria);			
		//CVarDumper::dump($Products);
		print_r ($Devices);
	}
	
	public function deleteRecord()
	{
	
		$Criteria = new CDbCriteria();
		//$Criteria->condition = "DATE(modified) > subdate(Date(modified), 1)";
		
		$Criteria->condition = 'DATE(created) = DATE(modified))';
		$Criteria->select = "name, mac_address, ip_address, hostname";
		$Devices = Devices::model()->findAll($Criteria);			
		//CVarDumper::dump($Products);
		print_r ($Devices);
	}
	
	public function actionIndex()
	{
		$result = $this->newRecord();
		//echo "Result of New Records :";
		//print_r ($result);
		
		$html = "New Records are\n;
		 <table border=1 width='50%'>
			  <th> Name</th>
			  <th>Mac</th>
			  <th>Ipaddar</th>
			  <th>Hostname</th>  ";
		           foreach($results as $query){
					   
			       $html .= "<tr><td align='center'>".$query['name']."</td>
					      <td align='center'>". $query['mac_address']."</td>
					      <td align='center'>". $query['ip_address']."</td>
					      <td align='center'>". $query['hostname']."</td></tr>";
				}
				   $html .= "</table>";
				   echo $html;
		
		//$result1 = $this->changeRecord();
		//echo "Result of Change Records are :";
		//print_r ($result1);
	}
	
}
?>