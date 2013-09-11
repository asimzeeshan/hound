<?php
/* @var $this DevicesController */
/* @var $model Devices */

$this->breadcrumbs=array(
	'Devices'=>array('admin'),
	$model->name,
);

?>

<h1>View Devices #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'emp_id',
		'name',
		'ip_address',
		'mac_address',
		'hostname',
		'description',
		'line_manager',
		'location',
		'hall',
		'opt',
		'created',
		'created_by',
		'modified',
		'modified_by',
	),
)); ?>
