<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	'Employees'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Employees', 'url'=>array('admin')),
);
?>

<h1>Create Employees</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>