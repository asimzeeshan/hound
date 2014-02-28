<?php
/* @var $this WhoisController */

$this->breadcrumbs=array(
	'Whois',
);
$selected = ((isset($_REQUEST['type']) && $_REQUEST['type'] == 'emp_id') ? 'emp_id' : 'ip_addr');
?>
<style type="text/css">
.foundit td {
	font-weight: bold;
	color: #090;
}
.notfound td {
	font-weight: bold;
	color: #F90;
}
.notice {
	background:#FBE3E4;
	color:#8a1f11;
	border-color:#FBC2C4;
}
</style>


<h1>Whois</h1>

<?php if(Yii::app()->user->hasFlash('whois_welcome')): ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('whois_welcome'); ?>
</div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('whois_failed')):?>
    <div class="flash-error">
        <?php echo Yii::app()->user->getFlash('whois_failed'); ?>
    </div>
<?php endif; ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>
  <div class="row">
        <?php 
        	echo CHtml::textField('search', '',
			array('id'=>'search', 
       		'width'=>100, 
       		'maxlength'=>100));
       	?>
    </div>
    <div class="row">
    	<label>Search In :</label>
        <?php echo CHtml::radioButtonList('type', $selected, array('ip_addr'=>'IP Address','emp_id'=>'Employee ID'),array(
		    'labelOptions'=>array('style'=>'display:inline'), // add this code
		    'separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;',
		)); ?>
    </div>
    <div class="row submit">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php
$emp_id = '';
if(count($userdata) > 0) {
	foreach ($userdata as $key => $value) {
		if($value['emp_id'] != '')
		{
			$emp_id = $value['emp_id'];
		}

		if ($value['ip_address']==$_POST['search']) {
			$class = " foundit"	;
		} elseif ($value['emp_id']==$_POST['search']) {
			$class = " foundit"	;
		} else {
			$class = " notfound";
		}
?>
<div class="view">
  <table cellspacing="2" cellpadding="3" align="center" class="<?php echo $class; ?>" border="1" >
    <tr>
      <td width="200">Employee ID</td>
      <td><?php echo $value['emp_id']; ?> <?php if($value['emp_id'] != ''){ ?>(
        <a href='<?php echo CController::createUrl('emailLogs/sendemail', array('emp_id' => $emp_id )); ?>'>REPORT?</a>
      )<?php } else { ?><font class="notice">MISSING EMPLOYEE ID</font><?php } ?></td>
    </tr>
    <tr>
      <td width="200">IP Address</td>
      <td><?php echo $value['ip_address']; ?></td>
    </tr>
    <tr>
      <td bgcolor="#FFFF00">LAN Segment</td>
      <td bgcolor="#FFFF00"><?php echo strtoupper($value['opt']); if (strstr($value['opt'], "c1")) { ?><font color="#FF0000"><b>WARNING: THIS RECORD MAY BE OLD</b></font><?php } ?></td>
    </tr>
    <tr>
      <td>HostName</td>
      <td><?php echo $value['hostname']; ?></td>
    </tr>
    <tr>
      <td>Employee Name</td>
      <td><?php echo $value['description']; ?></td>
    </tr>
    <tr>
      <td>Manager Name</td>
      <td><?php echo $value['line_manager']; ?></td>
    </tr>
    <tr>
      <td>Employee Location</td>
      <td><?php echo $value['location']; ?></td>
    </tr>
    <tr>
      <td>Sitting Hall</td>
      <td><?php echo $value['hall']; ?></td>
    </tr>
  </table>
</div>
<?php
	}
}
?>