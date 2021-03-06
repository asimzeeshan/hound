<?php
/* @var $this WhoisController */
$this->pageTitle=$this->pageTitle() . ' - Whois/index';
$this->breadcrumbs=array(
	'Whois'=>array('index'),
);
$selected = ((isset($_REQUEST['type']) && $_REQUEST['type'] == 'emp_id') ? 'emp_id' : 'ip_addr');
?>
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
  <?php
  		echo CHtml::beginForm();
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Who do you want to BUST today?",
		));
		$search = isset($_POST['search']) ? $_POST['search'] : '';
		echo CHtml::label('Search for', 'search');
      	echo CHtml::textField('search', $search,
			array('id'=>'search', 
       		'width'=>100, 
       		'maxlength'=>100));
		
		echo "&nbsp;&nbsp;";
		$this->widget('zii.widgets.jui.CJuiButton', array(
			'name'=>'yt0',
			'caption'=>'Search',
			'buttonType'=>'submit',
			'htmlOptions'=>array('class'=>'btn btn-info'),
		));
			
		echo CHtml::label('Search in','type');
		echo CHtml::radioButtonList('type', $selected, array('ip_addr'=>'IP Address','emp_id'=>'Employee ID'),array(
		    'labelOptions'=>array('style'=>'display:inline'), // add this code
		    'separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;',
		));
		//echo CHtml::submitButton('Search');

		$this->endWidget();
		echo CHtml::endForm();
	?>
</div><!-- form -->
<?php
$emp_id = '';

if(count($userdata) > 0 ) {
	foreach ($userdata as $key => $value) {
		
		if($value['emp_id'] != '')
		{
			$emp_id = $value['emp_id'];
		}

?>
<div class="view">
  <?php
  		$wtitle = $value['description']." (".$value['ip_address'].")";
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>$wtitle,
		));
		
	?>
  <table cellspacing="2" cellpadding="3" align="center" class="table table-striped" border="1" >
  <caption><?php
		
		?></caption>
  <tbody>
    <tr>
      <td width="200">Employee ID</td>
      <td><?php echo $value['emp_id']; ?> <?php if($value['emp_id'] != ''){ ?>
      <?php } else { ?><font class="notice">MISSING EMPLOYEE ID</font><?php } ?></td>
      
      <td rowspan="8" align="center" valign="middle" style="padding:4px; width:200px; vertical-align:middle; text-align:center"><?php 
		  $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
		  $colorbox->addInstance('.colorbox', array('maxHeight'=>'90%', 'maxWidth'=>'90%'));
		  if(isset($value['picture']))
		  echo CHtml::link(CHtml::image($value['picture']->pic,'alt',array('class'=>'border')),$value['picture']->pic, array('class'=>'colorbox'));
		$this->widget('zii.widgets.jui.CJuiButton', array(
			'name'=>'button',
			'caption'=>'View Work Space Location',
			'buttonType'=>'link',
			'htmlOptions'=>array('class'=>'btn btn-success colorbox space'),
			'url'=>$value['picture']->location_pic,
		));
		$this->widget('zii.widgets.jui.CJuiButton', array(
			'name'=>'button-'.rand(),
			'caption'=>'Report this?',
			'buttonType'=>'link',
			'htmlOptions'=>array('class'=>'btn btn-danger space'),
			'url'=>CController::createUrl('emailLogs/sendemail', array('emp_id' => $emp_id )),
		));
		$this->widget('zii.widgets.jui.CJuiButton', array(
			'name'=>'button',
			'caption'=>'Past Record',
			'htmlOptions'=>array('class'=>'btn btn-info space'),
		));
		
	  ?></td>
     
    </tr>
    <tr>
      <td width="200">IP Address</td>
      <td><?php echo $value['ip_address']; ?></td>
      </tr>
    <tr>
      <td bgcolor="#FFFF00">LAN Segment</td>
      <td bgcolor="#FFFF00"><?php echo strtoupper($value['opt']); if (strstr($value['opt'], "c1")) { ?> <font color="#FF0000"><b>WARNING: THIS RECORD MAY BE OLD</b></font><?php } ?></td>
      </tr>
    <tr>
      <td>HostName</td>
      <td><?php echo $value['hostname']; ?></td>
      </tr>
    <tr>
      <td>Description / Employee Name</td>
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
   </tbody>
  </table>
    <?php $this->endWidget();?>
</div>
<?php
	}
}
	
?>