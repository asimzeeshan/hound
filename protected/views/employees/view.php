<?php
/* @var $this EmployeesController */
/* @var $model Employees */
$this->pageTitle=$this->pageTitle() . ' - View';
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
<?php
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
$colorbox->addInstance('.colorbox', array('maxHeight'=>'90%', 'maxWidth'=>'90%'));
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
				'value'=>CHtml::link(CHtml::image($model->pic,'alt',array('class'=>'border')),$model->pic, array('class'=>'colorbox')),$model->pic, array('target'=>'_blank'),
				),
		'joining_date',
		'location',
		array(
				'name'=>'Workspace Location',
				'type'=>'raw',
				'value'=>CHtml::link(CHtml::image($model->location_pic,'alt',array('class'=>'border1')),$model->location_pic, array('class'=>'colorbox')),$model->pic, array('target'=>'_blank'),
				),
		'hall',
		array(
				'name'=>'manager1_id',
				'type'=>'raw',
				'value'=>$model->manager1_id==0 ? "n/a" : CHtml::link($model->manager1->name,array('managers/view','id'=>$model->manager1_id))."&nbsp; | &nbsp;".
				CHtml::link('View Employee Profile',array('employees/view','id'=>$model->managerProfile($model->manager1->name))),
				),
				
		array(
				'name'=>'manager2_id',
				'type'=>'raw',
				'value'=>$model->manager2_id==0 ? "n/a" : CHtml::link($model->manager2->name,array('managers/view','id'=>$model->manager2_id))."&nbsp; | &nbsp;".
				CHtml::link('View Employee Profile',array('employees/view','id'=>$model->managerProfile($model->manager2->name))),
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
<?php

?>