<?php
    // get the Html
    ob_start();
   	$devices = "<div style='color:black;background-color:#CCCCCC;' align='center' border=1>
					<h1>Records Of Devices W/O Employee ID</h1>
					</div><br/>
		 		  <table border=0.5 width='95%' style='margin-left:200px;'>
			  	  <tr>
			  	  <th align='center' width='45%'>Name</th>
			  	  <th align='center' width='16%'>Ip_Address</th>
			  	  <th align='center' width='16%'>Mac_Address</th>
				  <th align='center' width='16%'>Hostname</th>
   			  	</tr>  ";
		           foreach($model as $query){   
			      			$devices .= "<tr>
											 <td align='center'>". $query->name."</td>
											 <td align='center'>". $query->ip_address."</td>
											 <td align='center'>".$query->mac_address."</td>
											 <td align='center'>".$query->hostname."</td>
											 </tr>";
				}
				   			$devices .= "</table>";
				   echo $devices;			
    $content = ob_get_clean();
 
    // after getting html to  convert in Pdf format.
    Yii::import('application.extensions.tcpdf.HTML2PDF');
    try
    {
        $html2pdf = new HTML2PDF('L', 'A4', 'en');
     	//$html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output("W/O EmpId Devices.pdf");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>