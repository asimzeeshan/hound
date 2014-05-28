<?php
	$employees = "<div style='color:black;background-color:#CCCCCC;' align='center' border=1>
					<h1>Employees Records</h1>
					</div><br/>
		 		  <table border=0.5 width='95%' style='margin-left:125px;'>
			  	  <tr><th align='center' width='45%'> ID</th>
			  	  <th align='center' width='16%'>Emp Id</th>
			  	  <th align='center' width='16%'>Name</th>
			  	  <th align='center' width='16%'>Email</th>
				  <th align='center' width='16%'>Joining Date</th>
				  <th align='center' width='16%'>Location</th>
				  <th align='center' width='16%'>Hall</th>
			  	</tr>  ";
		           foreach($model as $query){   
			      			$employees .= "<tr><td align='center'>".$query->id."</td>
											 <td align='center'>". $query->emp_id."</td>
											 <td align='center'>". $query->name."</td>
											 <td align='center'>".$query->email."</td>
											 <td align='center'>".$query->joining_date."</td>
											 <td align='center'>".$query->location."</td>
											 <td align='center'>".$query->hall."</td>
											 </tr>";
				}
				   			$employees .= "</table>";
				   echo $employees;				   
?>
		