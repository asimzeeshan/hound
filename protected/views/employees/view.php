<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	'Employees'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Manage Employees', 'url'=>array('admin')),
	array('label'=>'Create Employees', 'url'=>array('create')),
	array('label'=>'Update Employees', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Employees', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Employees Record#<?php echo $model->id; ?></h1>

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
		array(
				'name'=>'opt',
				'value'=>strtoupper($model->opt),
				),		
		'created',
		array(
				'name'=>'created_by',
				'value'=>$model->CreatedBy->name(),
				),
		'modified',
		array(
				'name'=>'modified_by',
				'value'=>$model->ModifiedBy->name(),
				),
	),
)); ?>
