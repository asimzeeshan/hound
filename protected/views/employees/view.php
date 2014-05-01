<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	'Employees'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Employees', 'url'=>array('index')),
	array('label'=>'Create Employees', 'url'=>array('create')),
	array('label'=>'Update Employees', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Employees', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Employees', 'url'=>array('admin')),
);
?>

<h1>View Employees #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'emp_id',
		'name',
		'email',
		array(
				'name'=>'Photo',
				'type'=>'raw',
				'value'=>CHtml::link(CHtml::image($model->pic,'alt',array('width'=>'100px')),$model->pic, array('target'=>'_blank')),
				),
		'joining_date',
		'location',
		array(
				'name'=>'Workspace Location',
				'type'=>'raw',
				'value'=>CHtml::link(CHtml::image($model->location_pic,'alt',array('width'=>'750px')),$model->location_pic, array('target'=>'_blank')),
				),
		'hall',
		array(
				'name'=>'manager1_id',
				'value'=>$model->manager1_id==NULL ? "n/a" : $model->manager1->details(),
				),
		array(
				'name'=>'manager2_id',
				'value'=>$model->manager2_id==NULL ? "n/a" : $model->manager2->details(),
				),
		'created',
		array(
				'name'=>'created_by',
				'value'=>$model->CreatedBy->name(),
				),
		'modified',
		array(
				'name'=>'modified_by',
				'value'=>$model->CreatedBy->name(),
				),
	),
)); ?>
